// Mobile menu toggle
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


// buyer.js - Buyer Home Page Functionality

document.addEventListener('DOMContentLoaded', function() {
    // 1. Search Functionality
    const searchBox = document.querySelector('.search-box input');
    const searchBtn = document.querySelector('.search-btn');

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
    const sortFilter = document.querySelector('.sort-filter');

    function applyFilters() {
        const category = categoryFilter.value;
        const sortBy = sortFilter.value;

        console.log(`Filtering by: ${category}, Sorting by: ${sortBy}`);
        // In a real app, this would filter/sort the product list
    }

    categoryFilter.addEventListener('change', applyFilters);
    sortFilter.addEventListener('change', applyFilters);

    // 3. Add to Cart Functionality
    const addCartBtns = document.querySelectorAll('.add-cart-btn');
    const cartCount = document.querySelector('.cart-count');

    addCartBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const productCard = this.closest('.product-card');
            const productName = productCard.querySelector('.product-title').textContent;

            // Update cart count
            let currentCount = parseInt(cartCount.textContent) || 0;
            cartCount.textContent = currentCount + 1;

            // Visual feedback
            this.innerHTML = '<i class="fas fa-check"></i> Added';
            this.style.backgroundColor = '#28a745';

            // In a real app, this would add to cart in your backend
            console.log(`Added to cart: ${productName}`);

            // Reset button after 2 seconds
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-cart-plus"></i> Add';
                this.style.backgroundColor = '';
            }, 2000);
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
});