document.addEventListener( 'DOMContentLoaded', async function () {
    await renderCart();
    const removeButtons = document.querySelectorAll('.remove-btn');

    removeButtons.forEach(btn => {
        btn.addEventListener('click', async () => {
        const productId = btn.dataset.productId;
        try {
            const res = await fetch('../core/cart.php', {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `product_id=${productId}`
            });
            const result = await res.json();
            if (result.success) {
                renderCart();
                window.location.reload();
            } else {
                alert('Failed to remove item: ' + result.error);
            }
        } catch (error) {
            console.error('Delete failed', error);
            }
        });
    });

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
        confirmBtn.addEventListener('click', async function () {
            try {
                const cartRes = await fetch('../core/cart.php');
                const cartData = await cartRes.json();

                if (!cartData.success || !Array.isArray(cartData.items) || cartData.items.length === 0) {
                    alert('No cart data found. Please add items before confirming.');
                    return;
                }

                const product_ids = cartData.items.map(item => item.product_id);
                const total_amount = Number(cartData.subtotal.toFixed(2));
                const formData = new FormData();
                product_ids.forEach(id => {
                    formData.append('product_ids[]', id);
                });
                formData.append( 'total_amount', +total_amount );

                const orderRes = await fetch('../core/order.php', {
                    method: 'POST',
                    body: formData,
                });

                const result = await orderRes.json();

                if (result.success) {
                    alert('Order placed successfully!');
                    window.location.href = 'buyer-orders.php';
                } else {
                    alert(result.error || 'Order failed. Please try again.');
                }

            } catch (err) {
                console.error('Checkout error:', err);
                alert('An error occurred during checkout.');
            }

            modalOverlay.classList.add('hidden');
        });
    }

    modalOverlay.addEventListener('click', function(e) {
        if (e.target === modalOverlay) {
            modalOverlay.classList.add('hidden');
        }
    });

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
            emptyMsg.textContent = 'No cart data available';
            emptyMsg.style.textAlign = 'center';
            emptyMsg.style.fontSize = '2.4rem';
            emptyMsg.style.color = '#aaa';
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
        main.innerHTML = '<p style="text-align:center;"> Something went wrong loading the cart.</p>';
    }
}

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