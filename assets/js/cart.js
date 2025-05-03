document.addEventListener( 'DOMContentLoaded', async function () {
    await renderCart();
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
} );

async function renderCart() {
    const main = document.querySelector('main.cart-container');
    main.innerHTML = '';

    try {
        const response = await fetch('../core/cart.php');
        const data = await response.json();

        const title = document.createElement('h1');
        title.className = 'cart-title';
        title.textContent = 'Your Cart';
        main.appendChild(title);

        if (!data.success || data.items.length === 0) {
            const emptyMsg = document.createElement('p');
            emptyMsg.textContent = '🛒 No cart data available';
            emptyMsg.style.textAlign = 'center';
            emptyMsg.style.fontSize = '1.2rem';
            emptyMsg.style.marginTop = '2rem';
            main.appendChild(emptyMsg);
            return;
        }

        const itemsContainer = document.createElement('div');
        itemsContainer.className = 'cart-items';

        data.items.forEach(item => {
            const itemDiv = document.createElement('div');
            itemDiv.className = 'cart-item';

            itemDiv.innerHTML = `
                <img src="../${item.first_image}" alt="${item.title}" class="product-image">
                <div class="product-info">
                    <h3>${item.title}</h3>
                    <p class="product-price">ETB ${parseFloat(item.price).toLocaleString()}</p>
                    <div class="product-actions">
                        <a href="product.php?product_id=${item.product_id}" class="detail-btn">See Details</a>
                        <button class="remove-btn" data-product-id="${item.product_id}">Remove</button>
                    </div>
                </div>
            `;

            itemsContainer.appendChild(itemDiv);
        });

        const subtotal = parseFloat(data.subtotal).toFixed(2);
        const summary = document.createElement('div');
        summary.className = 'order-summary';
        summary.innerHTML = `
            <div class="summary-row">
                <span>Subtotal:</span>
                <span>ETB ${parseFloat(subtotal).toLocaleString()}</span>
            </div>
            <div class="summary-row">
                <span>Delivery Fee:</span>
                <span>ETB 0</span>
            </div>
            <div class="summary-row total">
                <span>Total:</span>
                <span>ETB ${parseFloat(subtotal).toLocaleString()}</span>
            </div>
        `;

        const checkoutBtn = document.createElement('button');
        checkoutBtn.className = 'checkout-btn';
        checkoutBtn.textContent = 'Proceed to Checkout';

        main.appendChild(itemsContainer);
        main.appendChild(summary);
        main.appendChild(checkoutBtn);

    } catch (err) {
        console.error('Failed to load cart:', err);
        main.innerHTML = '<p style="text-align:center;">❌ Something went wrong loading the cart.</p>';
    }
}
