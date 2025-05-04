document.addEventListener( 'DOMContentLoaded', async function () {
    const response = await fetch( '../core/orders-fetcher.php?type=buyer' );
    const data = await response.json();
    if ( data.success ) {
        renderOrders(data)
    };
    const cancelButtons = document.querySelectorAll('.cancel-btn:not(:disabled)');
    const reportButtons = document.querySelectorAll('.report-btn');
    const cancelModal = document.getElementById('cancelModal');
    const reportModal = document.getElementById('reportModal');
    const confirmCancel = document.getElementById('confirmCancel');
    const closeCancel = document.getElementById('closeCancel');
    const submitReport = document.getElementById('submitReport');
    const closeReport = document.getElementById('closeReport');

    let currentOrder = null;

    // Cancel Order functionality
    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            currentOrder = this.closest('.order-card');
            cancelModal.style.display = 'flex';
        });
    });

    // Report Issue functionality
    reportButtons.forEach(button => {
        button.addEventListener('click', function() {
            currentOrder = this.closest('.order-card');
            reportModal.style.display = 'flex';
        });
    });

    // Confirm Cancel
    confirmCancel.addEventListener('click', function() {
        if (currentOrder) {
            // In a real app, you would send a request to your backend here
            const statusElement = currentOrder.querySelector('.order-status');
            statusElement.textContent = 'Cancelled';
            statusElement.setAttribute('data-status', 'Cancelled');
            statusElement.style.backgroundColor = '#f8d7da';
            statusElement.style.color = '#721c24';

            // Disable cancel button
            const cancelBtn = currentOrder.querySelector('.cancel-btn');
            cancelBtn.disabled = true;

            // Close modal
            cancelModal.style.display = 'none';

            // Show success message
            alert('Order has been cancelled successfully.');
        }
    });

    // Close Cancel Modal
    closeCancel.addEventListener('click', function() {
        cancelModal.style.display = 'none';
    });

    // Submit Report
    submitReport.addEventListener('click', function() {
        const reportText = reportModal.querySelector('textarea').value.trim();

        if (reportText === '') {
            alert('Please describe the issue before submitting.');
            return;
        }

        // In a real app, you would send this to your backend
        console.log('Report submitted for order:', currentOrder.querySelector('.order-id').textContent);
        console.log('Report content:', reportText);

        // Clear and close
        reportModal.querySelector('textarea').value = '';
        reportModal.style.display = 'none';

        // Show success message
        alert('Your report has been submitted. We will contact you soon.');
    });

    // Close Report Modal
    closeReport.addEventListener('click', function() {
        reportModal.querySelector('textarea').value = '';
        reportModal.style.display = 'none';
    });

    // Close modals when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === cancelModal) {
            cancelModal.style.display = 'none';
        }
        if (event.target === reportModal) {
            reportModal.querySelector('textarea').value = '';
            reportModal.style.display = 'none';
        }
    });
} );


function renderOrders(data) {
    const container = document.querySelector('.orders-container');

    // Clear previous content
    container.innerHTML = '';

    // Title
    const heading = document.createElement('h1');
    heading.textContent = 'My Orders';
    container.appendChild(heading);

    // Orders list wrapper
    const ordersList = document.createElement('div');
    ordersList.className = 'orders-list';

    if (data.success && data.orders.length > 0) {
        data.orders.forEach(order => {
            const orderCard = document.createElement('div');
            orderCard.className = 'order-card';

            // Format order date
            const orderDate = new Date(order.order_date);
            const formattedDate = orderDate.toLocaleDateString('en-US', {
                year: 'numeric', month: 'short', day: 'numeric'
            });

            // Fake status for now (you can later replace this with actual status from DB)
            let status = 'Processing';

            // Header
            orderCard.innerHTML = `
                <div class="order-header">
                    <span class="order-id">Order #${order.order_id}</span>
                    <span class="order-date">Placed on ${formattedDate}</span>
                    <span class="order-status">${status}</span>
                </div>

                <div class="order-details">
                    <img src="../${order.first_image}" alt="Product" class="product-image">
                    <div class="product-info">
                        <h3>${order.title}</h3>
                        <p>Seller: ${order.seller_name}</p>
                        <p class="price">$${parseFloat(order.price).toFixed(2)}</p>
                    </div>
                </div>

                <div class="order-actions">
                    <button class="cancel-btn">Cancel Order</button>
                    <button class="report-btn">Report Issue</button>
                </div>
            `;
            ordersList.appendChild(orderCard);
        });
    } else {
        ordersList.innerHTML = '<p>No orders found.</p>';
    }

    container.appendChild(ordersList);
}
