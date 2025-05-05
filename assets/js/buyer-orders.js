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

    let orderId;
    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            currentOrder = this.closest( '.order-card' );
            orderId = button.getAttribute( 'data-order-id' );
            cancelModal.style.display = 'flex';
        });
    });

    reportButtons.forEach(button => {
        button.addEventListener('click', function() {
            currentOrder = this.closest( '.order-card' );
            orderId = button.getAttribute( 'data-order-id' );
            reportModal.style.display = 'flex';
        });
    });

    confirmCancel.addEventListener( 'click', async function () {
        const formData = new FormData();
        formData.append( 'action', 'update_status' );
        formData.append( 'order_id', orderId);
        formData.append( 'status', 'canceled' );
        const response = await fetch( '../core/order.php', {
            method: 'POST',
            body: formData
        } );
        const data = await response.json();
        if ( data.success ) {
            alert( 'You order is Cancelled.' );
            window.location.reload();
        }
    });

    closeCancel.addEventListener('click', function() {
        cancelModal.style.display = 'none';
    });

    submitReport.addEventListener('click', async function() {
        const reportText = reportModal.querySelector( 'textarea' ).value.trim();

        if (reportText === '') {
            alert('Please describe the issue before submitting.');
            return;
        }

        const formData = new FormData();
        formData.append( 'report_text', reportText );
        formData.append( 'order_id', orderId );

        const response = await fetch( '../core/report_orders.php', {
            method: 'POST',
            body: formData,
        } );
        const data = await response.json();

        if ( data.success ) {
            alert('Your report has been submitted. We will contact you soon.');
        } else {
            alert('Your report has not submitted. Please Try again Later.');
        }
        reportModal.querySelector('textarea').value = '';
        reportModal.style.display = 'none';
    });

    closeReport.addEventListener('click', function() {
        reportModal.querySelector('textarea').value = '';
        reportModal.style.display = 'none';
    });

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

    container.innerHTML = '';

    const heading = document.createElement('h1');
    heading.textContent = 'My Orders';
    container.appendChild(heading);

    const ordersList = document.createElement('div');
    ordersList.className = 'orders-list';

    if (data.success && data.orders.length > 0) {
        data.orders.forEach(order => {
            const orderCard = document.createElement('div');
            orderCard.className = 'order-card';

            const orderDate = new Date(order.order_date);
            const formattedDate = orderDate.toLocaleDateString('en-US', {
                year: 'numeric', month: 'short', day: 'numeric'
            });

            orderCard.innerHTML = `
                <div class="order-header">
                    <span class="order-id">Order #${order.order_id}</span>
                    <span class="order-date">Placed on ${formattedDate}</span>
                    <span class="order-status">${order.status}</span>
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
                    <button ${order.status !== 'pending' ? 'disabled' : ''}  data-order-id=${order.order_id} class="cancel-btn">Cancel Order</button>
                    <button class="report-btn" data-order-id=${order.order_id} >Report Issue</button>
                </div>
            `;
            ordersList.appendChild( orderCard );
        });
    } else {
        ordersList.innerHTML = '<p class="fall-back-text">No orders found.</p>';
    }

    container.appendChild( ordersList );
}
