document.addEventListener( 'DOMContentLoaded', async function () {
    const response = await fetch( '../core/orders-fetcher.php?type=seller' );
    const data = await response.json();
    if ( data.success ) {
        renderSellerOrders( data );
    }
    document.querySelectorAll('.status-btn').forEach(button => {
        button.addEventListener('click', function () {
            const orderCard = this.closest('.order-card');
            const rawOrderId = orderCard.querySelector('.order-id').textContent;
            const orderId = rawOrderId.replace('#ORD-', '').toLowerCase(); // Clean up formatted ID

            let newStatus = '';
            let actionText = '';

            if (this.classList.contains('mark-completed')) {
                newStatus = 'completed';
                actionText = 'Completed';
            } else if (this.classList.contains('mark-canceled')) {
                newStatus = 'canceled';
                actionText = 'Canceled';
            }

            if (!newStatus) return;

            if (confirm(`Mark order ${rawOrderId} as ${actionText}?`)) {
                // Update UI
                orderCard.className = `order-card ${newStatus}`;
                orderCard.querySelector('.order-status').textContent = actionText;

                // Remove actions after status change
                const actionsDiv = orderCard.querySelector('.order-actions');
                actionsDiv.innerHTML = ''; // Clear buttons after status change

                // You would make a real backend call here
                console.log(`Order ${orderId} status updated to ${newStatus}`);
            }
        });
    });
});


function renderSellerOrders ( data ) {
    const container = document.querySelector('.orders-container');

    // Clear existing content
    container.innerHTML = '';

    // Add heading
    const heading = document.createElement('h1');
    heading.textContent = 'My Product Orders';
    container.appendChild(heading);

    // Create orders list container
    const ordersList = document.createElement('div');
    ordersList.className = 'orders-list';

    if (data.success && data.orders.length > 0) {
        data.orders.forEach(order => {
            const statusClass = order.status.toLowerCase(); // pending, completed, canceled
            const orderCard = document.createElement('div');
            orderCard.className = `order-card ${statusClass}`;

            const orderDate = new Date(order.order_date);
            const formattedDate = orderDate.toLocaleDateString('en-US', {
                year: 'numeric', month: 'short', day: 'numeric'
            });

            const orderIdDisplay = `#ORD-${order.order_id.slice(0, 8).toUpperCase()}`;
            const capitalizedStatus = order.status.charAt(0).toUpperCase() + order.status.slice(1);

            orderCard.innerHTML = `
                <div class="order-header">
                    <span class="order-id">${orderIdDisplay}</span>
                    <span class="order-date">${formattedDate}</span>
                    <span class="order-status">${capitalizedStatus}</span>
                </div>

                <div class="order-details">
                    <div class="product-info">
                        <img src="../${order.first_image}" alt="${order.title}">
                        <div>
                            <h3>${order.title}</h3>
                            <p>ETB ${parseFloat(order.price).toFixed(2)} × 1</p>
                        </div>
                    </div>

                    <div class="buyer-info">
                        <p><i class="fas fa-user"></i> <strong>${order.buyer_name}</strong></p>
                        <p><i class="fas fa-map-marker-alt"></i> ${order.delivery_location}</p>
                    </div>
                </div>

                <div class="order-actions">
                    ${generateActionButton(order.status, order.order_id)}
                </div>
            `;

            ordersList.appendChild(orderCard);
        });
    } else {
        ordersList.innerHTML = '<p>No product orders found.</p>';
    }

    container.appendChild(ordersList);
}

function generateActionButton(status, orderId) {
    status = status.toLowerCase();
    if (status === 'pending') {
        return `
            <button class="status-btn mark-completed" onclick="markOrderCompleted('${orderId}')">
                <i class="fas fa-check-circle"></i> Mark as Completed
            </button>
        `;
    } else {
        return '';
    }
}

function markOrderCompleted(orderId) {
    alert('Marking order ' + orderId + ' as completed...');
    // You can add an AJAX call here to actually update the order
}

function generateActionButton(status, orderId) {
    if (status === 'pending') {
        return `
            <button class="status-btn mark-completed">
                <i class="fas fa-check-circle"></i> Mark as Completed
            </button>
            <button class="status-btn mark-canceled">
                <i class="fas fa-times-circle"></i> Cancel Order
            </button>
        `;
    } else {
        return '';
    }
}
