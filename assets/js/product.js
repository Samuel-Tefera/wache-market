document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.querySelector('.main-image img');

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            thumbnails.forEach(t => t.classList.remove('active'));

            this.classList.add('active');

            const thumbSrc = this.querySelector('img').src;
            mainImage.src = thumbSrc.replace('200', '800');
        });
    });

    const addToCartBtn = document.querySelector('.add-to-cart-btn');

    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function() {
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check"></i> Added to Cart';
            this.style.backgroundColor = '#28a745';

            const productName = document.querySelector('h1').textContent;
            console.log(`Added to cart: ${productName}`);

            setTimeout(() => {
                this.innerHTML = originalText;
                this.style.backgroundColor = '';
            }, 2000);
        });
    }

    const backBtn = document.querySelector('.back-btn');

    if (backBtn) {
        backBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'buyer-home.php';
        });
    }
} );

async function fetchProductDetail () {
    params = new URLSearchParams( window.location.search );
    console.log(params.toString());

    const response = await fetch( `../core/product.php?${ params.toString() }` );
    const data = await response.json();

    if ( data.success && data.product) {
        renderProductDetailUI( data.product );
    } else if ( !data.product ) {
        showFallbackMessage( 'Oops! We couldn’t find the product you’re looking for.' );
    }
    else {
        showFallbackMessage( 'Oops! Failed to load product. Please try again later.' );
    }
};

fetchProductDetail();

function renderProductDetailUI(product) {
    const main = document.querySelector( '.product-container' );

    main.innerHTML = `
        <section class="image-gallery">
            <div class="main-image">
                <img src="../${product.image_paths[0]}" alt="${product.title}">
            </div>
            <div class="thumbnails">
                ${product.image_paths.map((path, i) => `
                    <div class="thumbnail ${i === 0 ? 'active' : ''}">
                        <img src="../${path}" alt="Thumbnail ${i + 1}">
                    </div>
                `).join('')}
            </div>
        </section>
        <section class="product-info">
            <div class="category-badge">${capitalizeFirstLetter(product.category)}</div>
            <h1>${product.title}</h1>
            <div class="price">ETB ${product.price}</div>

            <div class="seller-info">
                <i class="fas fa-user"></i>
                <span>Sold by: <strong>${product.seller_name}</strong></span>
            </div>

            <div class="description">
                <h3>Description</h3>
                <p>${product.description}</p>
            </div>
        </section>
        <div class="add-to-cart-container">
            <button class="add-to-cart-btn">
                <i class="fas fa-cart-plus"></i> Add to Cart
            </button>
        </div>
    `;

    // Re-bind thumbnail image switching
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.querySelector('.main-image img');

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function () {
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            const thumbSrc = this.querySelector('img').src;
            mainImage.src = thumbSrc.replace('200', '800');
        });
    });

    // Add to Cart button interaction
    const addToCartBtn = document.querySelector('.add-to-cart-btn');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function () {
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check"></i> Added to Cart';
            this.style.backgroundColor = '#28a745';

            const productName = document.querySelector('h1').textContent;
            console.log(`Added to cart: ${productName}`);

            setTimeout(() => {
                this.innerHTML = originalText;
                this.style.backgroundColor = '';
            }, 2000);
        });
    }
}

// Capitalize first letter helper
function capitalizeFirstLetter(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function showFallbackMessage(message) {
    const main = document.querySelector('.product-container');
    main.innerHTML = `
        <div class="fallback-message">
            <p>${message}</p>
        </div>
    `;
}
