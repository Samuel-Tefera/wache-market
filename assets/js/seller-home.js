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
    fetchSellerData();
    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.seller-nav-center .nav-links a');

    navLinks.forEach(link => {
        const linkPage = link.getAttribute('href').split('/').pop();
        if (currentPage === linkPage) {
            link.classList.add('active');
        }
    });
} );

async function fetchSellerData () {
    const response = await fetch( '../core/product.php' );
    const data = await response.json();
    if ( response.ok ) {
        renderSellerDashboard( data );
    } else {
        showFallbackMessage( 'Oops. Something went wrong. Please try again!' );
    }
};

function renderSellerDashboard(data) {
    const main = document.querySelector('.seller-dashboard');
    if ( !data || !data.success ) return;

    const statsSection = `
        <section class="stats-section">
            <div class="stats-card">
                <div class="stats-icon"><i class="fas fa-box-open"></i></div>
                <div class="stats-info">
                    <h3>Total Products</h3>
                    <p class="stats-value">${data.total_products}</p>
                </div>
            </div>
            <div class="stats-card">
                <div class="stats-icon"><i class="fas fa-clock"></i></div>
                <div class="stats-info">
                    <h3>Pending Orders</h3>
                    <p class="stats-value">${data.pending_orders}</p>
                </div>
            </div>
            <div class="stats-card">
                <div class="stats-icon"><i class="fas fa-chart-line"></i></div>
                <div class="stats-info">
                    <h3>This Month's Sales</h3>
                    <p class="stats-value">ETB ${data.monthly_sales}</p>
                </div>
            </div>
        </section>
    `;

    let productsSection;

    if ( data.products.length === 0 ) {
        productsSection = `
            <section class="product-section">
                <div class="section-header">
                    <h2>Your Products</h2>
                    <a href="add-product.php" class="add-product-btn">
                        <i class="fas fa-plus"></i> Add Product
                    </a>
                </div>
                <div class="fallback-message">
                    <p>No products found. Start by adding your first product!</p>
                </div>
            </section>
        `
    } else {
        const rows = data.products.map(product => `
            <tr>
                <td class="product-cell">
                    <img src="../${product.first_image}" alt="Product" class="product-thumb">
                    <span>${product.title}</span>
                </td>
                <td>ETB ${parseFloat(product.price).toLocaleString()}</td>
                <td>${product.quantity_available}</td>
                <td><span class="status-badge ${product.status === 'Active' ? 'active' : 'inactive'}">${product.status}</span></td>
                <td class="actions-cell">
                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `).join('');

        productsSection = `
            <section class="products-section">
                <div class="section-header">
                    <h2>Your Products</h2>
                    <a href="add-product.php" class="add-product-btn">
                        <i class="fas fa-plus"></i> Add Product
                    </a>
                </div>
                <div class="products-table-container">
                    <table class="products-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${rows}
                        </tbody>
                    </table>
                </div>
            </section>
        `;
    }


    main.innerHTML = statsSection + productsSection;
}

function showFallbackMessage(message) {
    const main = document.querySelector('.seller-dashboard');
    main.innerHTML = `
        <div class="fallback-message">
            <p>${message}</p>
        </div>
    `;
}