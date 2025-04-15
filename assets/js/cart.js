document.addEventListener('DOMContentLoaded', function() {
    // Remove Item Functionality
    const removeButtons = document.querySelectorAll('.remove-btn');

    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const cartItem = this.closest('.cart-item');
            cartItem.style.animation = 'fadeOut 0.3s ease';

            setTimeout(() => {
                cartItem.remove();
                // In a real app, you would update the total here
            }, 300);
        });
    });

    // Checkout Confirmation Modal
    const checkoutBtn = document.querySelector('.checkout-btn');
    const modalOverlay = document.querySelector('.modal-overlay');
    const cancelBtn = document.querySelector('.cancel-btn');
    const confirmBtn = document.querySelector('.confirm-btn');

    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function() {
            modalOverlay.classList.remove('hidden');
        });
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            modalOverlay.classList.add('hidden');
        });
    }

    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            // In a real app, this would process the checkout
            alert('Checkout completed! Redirecting to order confirmation...');
            modalOverlay.classList.add('hidden');
            // window.location.href = 'checkout.html';
        });
    }

    // Close modal when clicking outside
    modalOverlay.addEventListener('click', function(e) {
        if (e.target === modalOverlay) {
            modalOverlay.classList.add('hidden');
        }
    });

    // Add animation for removed items
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-20px); }
        }
    `;
    document.head.appendChild(style);
});