const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const navCenter = document.querySelector('.seller-nav-center');

if (mobileMenuBtn && navCenter) {
    mobileMenuBtn.addEventListener('click', () => {
        navCenter.classList.toggle('active');
        mobileMenuBtn.innerHTML = navCenter.classList.contains('active')
            ? '<i class="fas fa-times"></i>'
            : '<i class="fas fa-bars"></i>';
    });
}

document.addEventListener( 'DOMContentLoaded', function () {
    const resolveModal = document.getElementById('resolveModal');
    const confirmResolve = document.getElementById('confirmResolve');
    const cancelResolve = document.getElementById('cancelResolve');
    const filterStatus = document.getElementById('filterStatus');
    const reportCount = document.getElementById('reportCount');
    const reportList = document.querySelector('.reports-list');
    let currentReport = null;

    fetch('../core/report_orders.php')
        .then(response => response.json())
        .then(data => {
            if (data.reports && Array.isArray(data.reports)) {
                reportList.innerHTML = '';
                data.reports.forEach(report => {
                    const card = document.createElement('div');
                    card.className = 'report-card';
                    card.setAttribute('data-status', report.is_resolved == 1 ? 'resolved' : 'pending');

                    card.innerHTML = `
                        <div class="report-header">
                            <span class="report-id">REPORT #${report.report_id}</span>
                            <span class="report-date">${new Date(report.created_at).toLocaleDateString()}</span>
                            <span class="report-status">${report.is_resolved == 1 ? 'Resolved' : 'Pending'}</span>
                        </div>

                        <div class="report-details">
                            <div class="user-info">
                                <p><strong>From:</strong> ${report.buyer_name} (Buyer)</p>
                                <p><strong>Against:</strong> ${report.seller_name} (Seller)</p>
                                <p><strong>Order:</strong> #${report.order_id}</p>
                            </div>

                            <div class="report-content">
                                <h3>Issue Reported</h3>
                                <p>${report.report_text}</p>
                            </div>
                        </div>

                        <div class="report-actions">
                            <button class="resolve-btn" ${report.is_resolved == 1 ? 'disabled' : ''}>${report.is_resolved == 1 ? 'Resolved' : 'Mark as Resolved'}</button>
                            <button class="contact-btn">Contact Users</button>
                        </div>
                    `;

                    reportList.appendChild(card);
                });

                updateReportCount();
                initActionButtons();
            }
        })
        .catch(error => console.error('Error fetching reports:', error));

    function updateReportCount() {
        const pendingReports = document.querySelectorAll('.report-card[data-status="pending"]').length;
        if (reportCount) reportCount.textContent = pendingReports;
    }

    function initActionButtons() {
        const resolveButtons = document.querySelectorAll('.resolve-btn:not(:disabled)');
        const contactButtons = document.querySelectorAll('.contact-btn');

        resolveButtons.forEach(button => {
            button.addEventListener('click', function() {
                currentReport = this.closest('.report-card');
                resolveModal.style.display = 'flex';
            });
        });

        contactButtons.forEach(button => {
            button.addEventListener( 'click', async function () {
                const reportCard = this.closest('.report-card');
                const reportId = reportCard.querySelector('.report-id').textContent.replace('REPORT #', '');
                const response = await fetch( `../core/report_orders.php?report_id=${ reportId }` );
                const data = await response.json();
                if ( !data.error ) {
                    document.getElementById('buyerName').textContent = data.buyerInfo.full_name;
                    document.getElementById('buyerEmail').textContent = data.buyerInfo.email;
                    document.getElementById('buyerPhone').textContent = data.buyerInfo.phone;
                    document.getElementById('buyerAddress').textContent = data.buyerInfo.address;

                    document.getElementById('sellerName').textContent = data.sellerInfo.full_name;
                    document.getElementById('sellerEmail').textContent = data.sellerInfo.email;
                    document.getElementById('sellerPhone').textContent = data.sellerInfo.phone;
                    document.getElementById('sellerAddress').textContent = data.sellerInfo.address;

                    document.getElementById('contactModal').style.display = 'flex';
                } else {
                    alert('We got some problems while fetching user contacts.')
                }
            });
        });
    }

    confirmResolve.addEventListener('click', async function() {
        if (currentReport) {
            const reportId = currentReport.querySelector( '.report-id' ).textContent.replace( 'REPORT #', '' );
            const formData = { 'report_id': reportId };

            const response = await fetch( '../core/report_orders.php', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            } );

            const data = await response.json();
            console.log(data);

            if ( data.success ) {
                const statusElement = currentReport.querySelector('.report-status');
                statusElement.textContent = 'Resolved';
                currentReport.setAttribute('data-status', 'resolved');

                const resolveBtn = currentReport.querySelector('.resolve-btn');
                resolveBtn.disabled = true;
                resolveBtn.textContent = 'Resolved';

                updateReportCount();
                alert('Report marked as resolved.');
            } else {
                alert('Failed to resolve report.');
            }
            resolveModal.style.display = 'none';
        }
    });

    cancelResolve.addEventListener('click', function() {
        resolveModal.style.display = 'none';
    });

    filterStatus.addEventListener('change', function() {
        const status = this.value;
        const reports = document.querySelectorAll('.report-card');

        reports.forEach(report => {
            if (status === 'all') {
                report.style.display = 'block';
            } else {
                const reportStatus = report.getAttribute('data-status');
                report.style.display = reportStatus === status ? 'block' : 'none';
            }
        });
    });

    window.addEventListener('click', function(event) {
        if (event.target === resolveModal) {
            resolveModal.style.display = 'none';
        }
    });

    document.getElementById('closeContact').addEventListener('click', function() {
        document.getElementById('contactModal').style.display = 'none';
    });
});
