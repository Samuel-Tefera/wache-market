<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Wache-Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/product.css">
</head>
<body>
    <header class="product-header">
        <nav class="navbar">
            <div class="nav-left">
                <a href="#" class="logo">
                    <i class="fas fa-shopping-bag"></i>
                    Wache-Market
                </a>
            </div>
            <a href="index.html" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Home</a>
        </nav>
    </header>
    <!-- Product Content -->
    <main class="product-container">
        <!-- Image Gallery -->
        <section class="image-gallery">
            <div class="main-image">
                <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" alt="Product Image">
            </div>
            <div class="thumbnails">
                <div class="thumbnail active">
                    <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80" alt="Thumbnail 1">
                </div>
                <div class="thumbnail">
                    <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80" alt="Thumbnail 2">
                </div>
                <div class="thumbnail">
                    <img src="https://images.unsplash.com/photo-1541963463532-d68292c34b19?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80" alt="Thumbnail 3">
                </div>
                <div class="thumbnail">
                    <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80" alt="Thumbnail 4">
                </div>
            </div>
        </section>

        <!-- Product Info -->
        <section class="product-info">
            <div class="category-badge">Books</div>
            <h1>Engineering Mathematics 3rd Edition</h1>
            <div class="price">ETB 350</div>

            <div class="seller-info">
                <i class="fas fa-user"></i>
                <span>Sold by: <strong>John Doe</strong> (2nd Year Student)</span>
            </div>

            <div class="description">
                <h3>Description</h3>
                <p>This textbook is in excellent condition with minimal highlighting. Includes all chapters needed for MATH 301 course. No torn pages or water damage. Purchased new last semester.</p>
            </div>
        </section>

        <!-- Fixed Add to Cart Button -->
        <div class="add-to-cart-container">
            <button class="add-to-cart-btn">
                <i class="fas fa-cart-plus"></i> Add to Cart
            </button>
        </div>
    </main>

    <script src="../assets/js/product.js"></script>
</body>
</html>