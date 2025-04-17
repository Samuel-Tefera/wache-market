<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard - Wache-Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/seller-home.css">
</head>
<body>
    <!-- Navigation -->
    <header class="seller-header">
        <nav class="navbar">
            <div class="nav-left">
                <a href="#" class="logo">
                    <i class="fas fa-shopping-bag"></i>
                    Wache-Market
                </a>
            </div>
            <div class="seller-nav-center">
                <ul class="nav-links">
                    <li><a href="seller-home.php" class="active"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                    <li><a href="orders.php"><i class="fas fa-clipboard-list"></i> Orders</a></li>
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

    <!-- Main Content -->
    <main class="seller-dashboard">
        <!-- Stats Cards -->
        <section class="stats-section">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="stats-info">
                    <h3>Total Products</h3>
                    <p class="stats-value">24</p>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stats-info">
                    <h3>Pending Orders</h3>
                    <p class="stats-value">5</p>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stats-info">
                    <h3>This Month's Sales</h3>
                    <p class="stats-value">ETB 3,450</p>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stats-info">
                    <h3>Your Rating</h3>
                    <p class="stats-value">4.8 <small>/5</small></p>
                </div>
            </div>
        </section>

        <!-- Products Table -->
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
                            <th>Views</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="product-cell">
                                <img src="../assets/images/samples/mdeical-book1jpg.jpg" alt="Product" class="product-thumb">
                                <span>Engineering Textbook Vol.2</span>
                            </td>
                            <td>ETB 350</td>
                            <td>3</td>
                            <td>124</td>
                            <td><span class="status-badge active">Active</span></td>
                            <td class="actions-cell">
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        <tr>
                            <td class="product-cell">
                                <img src="../assets/images/samples/mdeical-book1jpg.jpg" alt="Product" class="product-thumb">
                                <span>Engineering Textbook Vol.2</span>
                            </td>
                            <td>ETB 350</td>
                            <td>3</td>
                            <td>124</td>
                            <td><span class="status-badge active">Active</span></td>
                            <td class="actions-cell">
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        <tr>
                            <td class="product-cell">
                                <img src="../assets/images/samples/mdeical-book1jpg.jpg" alt="Product" class="product-thumb">
                                <span>Engineering Textbook Vol.2</span>
                            </td>
                            <td>ETB 350</td>
                            <td>3</td>
                            <td>124</td>
                            <td><span class="status-badge active">Active</span></td>
                            <td class="actions-cell">
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        <tr>
                            <td class="product-cell">
                                <img src="../assets/images/samples/mdeical-book1jpg.jpg" alt="Product" class="product-thumb">
                                <span>Engineering Textbook Vol.2</span>
                            </td>
                            <td>ETB 350</td>
                            <td>3</td>
                            <td>124</td>
                            <td><span class="status-badge active">Active</span></td>
                            <td class="actions-cell">
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <!-- More rows would go here -->
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Recent Activity -->
        <section class="activity-section">
            <h2>Recent Activity</h2>
            <div class="activity-feed">
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="activity-content">
                        <p>New order received for <strong>Engineering Textbook</strong></p>
                        <small>10 minutes ago</small>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="activity-content">
                        <p>New order received for <strong>Engineering Textbook</strong></p>
                        <small>10 minutes ago</small>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="activity-content">
                        <p>New order received for <strong>Engineering Textbook</strong></p>
                        <small>10 minutes ago</small>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="activity-content">
                        <p>New order received for <strong>Engineering Textbook</strong></p>
                        <small>10 minutes ago</small>
                    </div>
                </div>
                <!-- More activity items would go here -->
            </div>
        </section>
    </main>

    <script src="seller.js"></script>
</body>
</html>