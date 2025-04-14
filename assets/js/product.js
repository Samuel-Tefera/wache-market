document.addEventListener('DOMContentLoaded', function() {
    // Thumbnail Gallery Interaction
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.querySelector('.main-image img');

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Remove active class from all thumbnails
            thumbnails.forEach(t => t.classList.remove('active'));

            // Add active class to clicked thumbnail
            this.classList.add('active');

            // Update main image (simple version - in production would use larger image)
            const thumbSrc = this.querySelector('img').src;
            mainImage.src = thumbSrc.replace('200', '800');
        });
    });

    // Add to Cart Functionality
    const addToCartBtn = document.querySelector('.add-to-cart-btn');

    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function() {
            // Visual feedback
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check"></i> Added to Cart';
            this.style.backgroundColor = '#28a745';

            // In a real app, this would connect to your cart system
            const productName = document.querySelector('h1').textContent;
            console.log(`Added to cart: ${productName}`);

            // Reset button after 2 seconds
            setTimeout(() => {
                this.innerHTML = originalText;
                this.style.backgroundColor = '';
            }, 2000);
        });
    }

    // Back Button Functionality
    const backBtn = document.querySelector('.back-btn');

    if (backBtn) {
        backBtn.addEventListener('click', function(e) {
            // In a real app, might use history.back() instead
            e.preventDefault();
            window.location.href = 'index.html';
        });
    }
});