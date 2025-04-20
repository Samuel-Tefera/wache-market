document.addEventListener('DOMContentLoaded', function() {
    // Filter orders by status
    const statusFilter = document.getElementById('status-filter');
    const orderCards = document.querySelectorAll('.order-card');

    statusFilter.addEventListener('change', function() {
        const selectedStatus = this.value;

        orderCards.forEach(card => {
            if (selectedStatus === 'all' || card.classList.contains(selectedStatus)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Search orders
    const searchInput = document.getElementById('search-orders');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        orderCards.forEach(card => {
            const orderText = card.textContent.toLowerCase();
            if (orderText.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Update order status
    document.querySelectorAll('.status-btn').forEach(button => {
        button.addEventListener('click', function() {
            const orderCard = this.closest('.order-card');
            const orderId = orderCard.querySelector('.order-id').textContent;

            // Determine new status based on button class
            let newStatus, actionText;

            if (this.classList.contains('mark-processing')) {
                newStatus = 'processing';
                actionText = 'processing';
            } else if (this.classList.contains('mark-shipped')) {
                newStatus = 'shipped';
                actionText = 'shipped';
            } else if (this.classList.contains('mark-delivered')) {
                newStatus = 'delivered';
                actionText = 'delivered';
            }

            // Confirm action
            if (confirm(`Mark order ${orderId} as ${actionText}?`)) {
                // Update UI
                orderCard.className = `order-card ${newStatus}`;
                orderCard.querySelector('.order-status').textContent = actionText;

                // Change button if needed
                if (newStatus === 'processing') {
                    this.innerHTML = '<i class="fas fa-truck"></i> Mark as Shipped';
                    this.className = 'status-btn mark-shipped';
                } else if (newStatus === 'shipped') {
                    this.innerHTML = '<i class="fas fa-check-circle"></i> Mark as Delivered';
                    this.className = 'status-btn mark-delivered';
                } else if (newStatus === 'delivered') {
                    this.style.display = 'none';
                }

                // In a real app, you would update the backend here
                console.log(`Order ${orderId} status updated to ${newStatus}`);
            }
        });
    });
});