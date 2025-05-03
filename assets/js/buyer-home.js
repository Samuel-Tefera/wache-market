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



document.addEventListener('DOMContentLoaded', async function() {
    // 1. Search Functionality
    const searchBox = document.querySelector( '.search-box input' );
    const searchBtn = document.querySelector('.search-btn');
    await fetchAndRenderProducts();

    function performSearch() {
        const searchTerm = searchBox.value.trim();
        const category = document.querySelector('.category-filter').value;

        // In a real app, this would call your backend API
        console.log(`Searching for: ${searchTerm} in category: ${category}`);
        alert(`Search functionality would show results for: "${searchTerm}" in ${category || 'all categories'}`);
    }

    searchBtn.addEventListener('click', performSearch);
    searchBox.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') performSearch();
    });

    // 2. Filter/Sort Functionality
    const categoryFilter = document.querySelector('.category-filter');
    // const sortFilter = document.querySelector('.sort-filter');

    function applyFilters() {
        const category = categoryFilter.value;
        // const sortBy = sortFilter.value;

        console.log(`Filtering by: ${category}, Sorting by: ${sortBy}`);
        // In a real app, this would filter/sort the product list
    }

    categoryFilter.addEventListener('change', applyFilters);
    // sortFilter.addEventListener('change', applyFilters);

    // 3. Add to Cart Functionality
    const addCartBtns = document.querySelectorAll('.add-cart-btn');

    addCartBtns.forEach(btn => {
    btn.addEventListener('click', async () => {
        // const productCard = btn.closest('.product-card');
        const productId = btn.getAttribute('data-product-id');

        const formData = new FormData();
        formData.append( 'product_id', productId );

        const response = await fetch( '../core/cart.php', {
            method: 'POST',
            body: formData,
        } );
        if ( response.ok ) {
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i> Added';
            btn.style.backgroundColor = '#28a745';
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.backgroundColor = '';
            }, 2000)
        } else {
            alert( 'Something Went Wrong. Please try agin later.' );
        }
    });
});

    // 4. View All Button Functionality
    const viewAllBtns = document.querySelectorAll('.view-all-btn');

    viewAllBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            const category = this.getAttribute('href').split('=')[1];
            console.log(`Viewing all products in category: ${category}`);
            // In a real app, this would navigate to category page
            // e.preventDefault(); // Uncomment to prevent actual navigation during testing
        });
    });

    // 5. Mobile Responsiveness (if needed)
    function handleMobileView() {
        if (window.innerWidth < 768) {
            // Mobile-specific adjustments
        }
    }

    window.addEventListener('resize', handleMobileView);
    handleMobileView();
} );

// /////////////////////////////////////////
// Organize and render product categories with max 6 per category
async function fetchAndRenderProducts(search = '', category = '') {
    try {
        let url = '../core/product.php';
        const params = new URLSearchParams(window.location.search);

        if (search) params.append('search', search);
        if (category) params.append('category', category);

        if (params.toString()) {
            url += '?' + params.toString();
        }

        const response = await fetch(url);
        const data = await response.json();

        if ( data.success ) {
            renderProductsByCategory( data.products );
        } else {
            console.log('Failed to fetch products:', data.error);
        }
    } catch (error) {
        console.log('Error fetching products:', error);
    }
};

function renderProductsByCategory(products) {
    const container = document.querySelector('.category-products');
    container.innerHTML = ''; // Clear old samples

    // Group products by category
    const grouped = products.reduce((acc, product) => {
        const category = product.category.toLowerCase();
        if (!acc[category]) acc[category] = [];
        acc[category].push(product);
        return acc;
    }, {});

    // Icons per category (optional)
    const categoryIcons = {
        textbooks: 'fa-book',
        electronics: 'fa-laptop',
        clothing: 'fa-tshirt',
        furniture: 'fa-couch',
        other: 'fa-box'
    };

    Object.entries(grouped).forEach(([category, items]) => {
        if (!items.length) return;

        const displayName = capitalize(category);
        const icon = categoryIcons[category] || 'fa-box';

        const topProducts = items.slice(0, 6);

        const section = document.createElement('div');
        section.className = 'category-section';

        section.innerHTML = `
            <div class="category-header">
                <h2><i class="fas ${icon}"></i> ${displayName}</h2>
                <a href="category.html?type=${category}" class="view-all-btn">View All</a>
            </div>
            <div class="products-grid">
                ${topProducts.map(p => renderProductCard(p)).join('')}
            </div>
        `;
        container.appendChild(section);
    });
}

function renderProductCard ( product ) {
    return `
        <div class="product-card">
            <div class="product-image">
                <img src="../${product.first_image}" alt="${product.title}">
            </div>
            <div class="product-details">
                <h3 class="product-title">${product.title}</h3>
                <div class="product-price">ETB ${parseFloat(product.price).toLocaleString()}</div>
                <div class="product-seller">
                    <i class="fas fa-user"></i> ${product.seller_name}
                </div>
                <div class="product-actions">
                    <a href="product.php?product_id=${product.product_id}" class="detail-btn">See Details</a>
                    <button class="add-cart-btn" data-product-id="${product.product_id}">
                        <i class="fas fa-cart-plus"></i> Add
                    </button>
                </div>
            </div>
        </div>
    `;
}

function capitalize(word) {
    return word.charAt(0).toUpperCase() + word.slice(1);
}
