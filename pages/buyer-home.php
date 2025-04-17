<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Home - Wache-Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/seller-home.css">
    <link rel="stylesheet" href="../assets/css/buyer-home.css">
</head>
<body>
    <header class="buyer-header">
        <nav class="navbar">
            <div class="nav-left">
                <a href="#" class="logo">
                    <i class="fas fa-shopping-bag"></i>
                    Wache-Market
                </a>
            </div>
            <div class="seller-nav-center">
                <ul class="nav-links">
                    <li><a href="buyer-home.php" class="active"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                    <li><a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a></li>
                </ul>
            </div>
            <div class="nav-right">
                <a href="#" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
        </nav>
    </header>
    <main class="buyer-main">
        <!-- Search and Filter Section -->
        <section class="search-filter-section">
            <div class="search-container">
                <div class="search-box">
                    <input type="text" placeholder="Search for products...">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="filter-options">
                    <select class="category-filter">
                        <option value="">All Categories</option>
                        <option value="books">Textbooks</option>
                        <option value="electronics">Electronics</option>
                        <option value="clothing">Clothing</option>
                        <option value="dorm">Dorm Items</option>
                    </select>
                    <select class="sort-filter">
                        <option value="newest">Newest First</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                    </select>
                </div>
            </div>
        </section>

        <!-- Products by Category -->
        <section class="category-products">
            <!-- Textbooks Category -->
            <div class="category-section">
                <div class="category-header">
                    <h2><i class="fas fa-book"></i> Books</h2>
                    <a href="#" class="view-all-btn">View All</a>
                </div>
                <div class="products-grid">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="../assets/images/samples/lelasw.jpg" alt="Lela Sew by Haddis Alemayehu">
                        </div>
                        <div class="product-details">
                            <h3 class="product-title">Lela Sew</h3>
                            <div class="product-price">ETB 250</div>
                            <div class="product-seller">
                                <i class="fas fa-user"></i> Alemayehu T.
                            </div>
                            <div class="product-actions">
                                <a href="product-detail.html" class="detail-btn">See Details</a>
                                <button class="add-cart-btn">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="../assets/images/samples/pysics.jpg" alt="Physics Textbook">
                        </div>
                        <div class="product-details">
                            <h3 class="product-title">Fundamentals of Physics</h3>
                            <div class="product-price">ETB 400</div>
                            <div class="product-seller">
                                <i class="fas fa-user"></i> Selam W.
                            </div>
                            <div class="product-actions">
                                <a href="product-detail.html" class="detail-btn">See Details</a>
                                <button class="add-cart-btn">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="../assets/images/samples/mdeical-book1jpg.jpg" alt="Medical Textbook Volume 1">
                        </div>
                        <div class="product-details">
                            <h3 class="product-title">Medical Principles Vol. 1</h3>
                            <div class="product-price">ETB 550</div>
                            <div class="product-seller">
                                <i class="fas fa-user"></i> Dr. Yohannes K.
                            </div>
                            <div class="product-actions">
                                <a href="product-detail.html" class="detail-btn">See Details</a>
                                <button class="add-cart-btn">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="../assets/images/samples/mdeicalbook2.jpg" alt="Medical Textbook Volume 2">
                        </div>
                        <div class="product-details">
                            <h3 class="product-title">Medical Principles Vol. 2</h3>
                            <div class="product-price">ETB 600</div>
                            <div class="product-seller">
                                <i class="fas fa-user"></i> Dr. Meseret A.
                            </div>
                            <div class="product-actions">
                                <a href="product-detail.html" class="detail-btn">See Details</a>
                                <button class="add-cart-btn">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="../assets/images/samples/database.jpg" alt="Database Systems Textbook">
                        </div>
                        <div class="product-details">
                            <h3 class="product-title">Database Systems</h3>
                            <div class="product-price">ETB 450</div>
                            <div class="product-seller">
                                <i class="fas fa-user"></i> Tekalign M.
                            </div>
                            <div class="product-actions">
                                <a href="product-detail.html" class="detail-btn">See Details</a>
                                <button class="add-cart-btn">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Electronics Category -->
            <div class="category-section">
                <div class="category-header">
                    <h2><i class="fas fa-laptop"></i> Electronics</h2>
                    <a href="category.html?type=electronics" class="view-all-btn">View All</a>
                </div>
                <div class="products-grid">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="../assets/images/samples/airpod1.jpg" alt="Apple AirPods Pro">
                        </div>
                        <div class="product-details">
                            <h3 class="product-title">Apple AirPods Pro</h3>
                            <div class="product-price">ETB 8,500</div>
                            <div class="product-seller">
                                <i class="fas fa-user"></i> Dawit (Graduate)
                            </div>
                            <div class="product-actions">
                                <a href="product-detail.html" class="detail-btn">See Details</a>
                                <button class="add-cart-btn">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="../assets/images/samples/phone1.jpg" alt="Samsung Galaxy S21">
                        </div>
                        <div class="product-details">
                            <h3 class="product-title">Samsung Galaxy S21</h3>
                            <div class="product-price">ETB 25,000</div>
                            <div class="product-seller">
                                <i class="fas fa-user"></i> Selam (Graduate)
                            </div>
                            <div class="product-actions">
                                <a href="product-detail.html" class="detail-btn">See Details</a>
                                <button class="add-cart-btn">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="../assets/images/samples/laptop1.jpg" alt="Dell Inspiron Laptop">
                        </div>
                        <div class="product-details">
                            <h3 class="product-title">Dell Inspiron i5 8th Gen</h3>
                            <div class="product-price">ETB 32,000</div>
                            <div class="product-seller">
                                <i class="fas fa-user"></i> Yohannes (Graduate)
                            </div>
                            <div class="product-actions">
                                <a href="product-detail.html" class="detail-btn">See Details</a>
                                <button class="add-cart-btn">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="../assets/images/samples/headphone2.jpg" alt="Sony WH-1000XM4 Headphones">
                        </div>
                        <div class="product-details">
                            <h3 class="product-title">Sony WH-1000XM4</h3>
                            <div class="product-price">ETB 15,000</div>
                            <div class="product-seller">
                                <i class="fas fa-user"></i> Kalkidan (Graduate)
                            </div>
                            <div class="product-actions">
                                <a href="product-detail.html" class="detail-btn">See Details</a>
                                <button class="add-cart-btn">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="../assets/images/samples/laptop2.jpg" alt="HP Pavilion Laptop">
                        </div>
                        <div class="product-details">
                            <h3 class="product-title">HP Pavilion i7 10th Gen</h3>
                            <div class="product-price">ETB 38,000</div>
                            <div class="product-seller">
                                <i class="fas fa-user"></i> Tewodros (Graduate)
                            </div>
                            <div class="product-actions">
                                <a href="product-detail.html" class="detail-btn">See Details</a>
                                <button class="add-cart-btn">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- More categories... -->
        </section>
    </main>

    <script src="../assets/js/buyer-home.js"></script>
</body>
</html>