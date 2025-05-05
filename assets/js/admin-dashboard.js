document.addEventListener('DOMContentLoaded', function() {
    // Get all elements
    const resolveButtons = document.querySelectorAll('.resolve-btn:not(:disabled)');
    const contactButtons = document.querySelectorAll('.contact-btn');
    const resolveModal = document.getElementById('resolveModal');
    const confirmResolve = document.getElementById('confirmResolve');
    const cancelResolve = document.getElementById('cancelResolve');
    const filterStatus = document.getElementById('filterStatus');
    const reportCount = document.getElementById('reportCount');

    // Store the current report being acted upon
    let currentReport = null;

    // Resolve Report functionality
    resolveButtons.forEach(button => {
        button.addEventListener('click', function() {
            currentReport = this.closest('.report-card');
            resolveModal.style.display = 'flex';
        });
    });

    // Contact Users functionality
    contactButtons.forEach(button => {
    button.addEventListener('click', function() {
        const reportCard = this.closest('.report-card');
        const reportId = reportCard.querySelector('.report-id').textContent;

        // In a real app, you would fetch this data from your backend
        // For demo purposes, we're using mock data
        const buyerInfo = {
            name: "John Doe",
            email: "buyer123@example.com",
            phone: "(555) 123-4567",
            address: "Block B, Dorm 305"
        };

        const sellerInfo = {
            name: "Jane Smith",
            email: "seller456@example.com",
            phone: "(555) 987-6543",
            address: "Block D, Dorm 112"
        };

        // Populate the modal with data
        document.getElementById('buyerName').textContent = buyerInfo.name;
        document.getElementById('buyerEmail').textContent = buyerInfo.email;
        document.getElementById('buyerPhone').textContent = buyerInfo.phone;
        document.getElementById('buyerAddress').textContent = buyerInfo.address;

        document.getElementById('sellerName').textContent = sellerInfo.name;
        document.getElementById('sellerEmail').textContent = sellerInfo.email;
        document.getElementById('sellerPhone').textContent = sellerInfo.phone;
        document.getElementById('sellerAddress').textContent = sellerInfo.address;

        // Show the contact modal
        document.getElementById('contactModal').style.display = 'flex';
        });
    });

    // Confirm Resolve
    confirmResolve.addEventListener('click', function() {
        if (currentReport) {
            // Update UI
            const statusElement = currentReport.querySelector('.report-status');
            statusElement.textContent = 'Resolved';
            statusElement.setAttribute('data-status', 'resolved');

            // Disable resolve button
            const resolveBtn = currentReport.querySelector('.resolve-btn');
            resolveBtn.disabled = true;
            resolveBtn.textContent = 'Resolved';

            // Update report count
            updateReportCount();

            // Close modal
            resolveModal.style.display = 'none';

            // Show success message
            alert('Report marked as resolved. Both parties will be notified.');
        }
    });

    // Cancel Resolve
    cancelResolve.addEventListener('click', function() {
        resolveModal.style.display = 'none';
    });

    // Filter reports
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

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === resolveModal) {
            resolveModal.style.display = 'none';
        }
    });

    // Update report count
    function updateReportCount() {
        const pendingReports = document.querySelectorAll('.report-card[data-status="pending"]').length;
        reportCount.textContent = pendingReports;
    }

    // Initialize report count
    updateReportCount();
} );


document.getElementById('closeContact').addEventListener('click', function() {
    document.getElementById('contactModal').style.display = 'none';
});

