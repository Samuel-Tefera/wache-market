<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - WatchE-Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/seller-home.css">
    <link rel="stylesheet" href="../assets/css/buyer-home.css">
    <link rel="stylesheet" href="../assets/css/buyer-orders.css">
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
                    <li><a href="buyer-home.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                    <li><a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a></li>
                    <li><a href="buyer-orders.php" class="active"><i class="fas fa-clipboard-list"></i> Orders</a></li>
                </ul>
            </div>
            <div class="nav-right">
                <a href="../core/logout.php" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
        </nav>
    </header>
    <div class="orders-container">
        <h1>My Orders</h1>

        <div class="orders-list">
            <!-- Order 1 -->
            <div class="order-card">
                <div class="order-header">
                    <span class="order-id">Order #WE235689</span>
                    <span class="order-date">Placed on Oct 12, 2023</span>
                    <span class="order-status">Processing</span>
                </div>

                <div class="order-details">
                    <img src="https://via.placeholder.com/80" alt="Product" class="product-image">
                    <div class="product-info">
                        <h3>Calculus Textbook 2023 Edition</h3>
                        <p>Seller: JohnDoe</p>
                        <p class="price">$45.99</p>
                    </div>
                </div>

                <div class="order-actions">
                    <button class="cancel-btn">Cancel Order</button>
                    <button class="report-btn">Report Issue</button>
                </div>
            </div>

            <!-- Order 2 -->
            <div class="order-card">
                <div class="order-header">
                    <span class="order-id">Order #WE874562</span>
                    <span class="order-date">Placed on Oct 5, 2023</span>
                    <span class="order-status">Shipped</span>
                </div>

                <div class="order-details">
                    <img src="https://via.placeholder.com/80" alt="Product" class="product-image">
                    <div class="product-info">
                        <h3>Wireless Earbuds</h3>
                        <p>Seller: TechGuru</p>
                        <p class="price">$29.99</p>
                    </div>
                </div>

                <div class="order-actions">
                    <button class="cancel-btn" disabled>Cancel Order</button>
                    <button class="report-btn">Report Issue</button>
                </div>
            </div>

            <!-- Order 3 -->
            <div class="order-card">
                <div class="order-header">
                    <span class="order-id">Order #WE124578</span>
                    <span class="order-date">Placed on Sep 28, 2023</span>
                    <span class="order-status">Delivered</span>
                </div>

                <div class="order-details">
                    <img src="https://via.placeholder.com/80" alt="Product" class="product-image">
                    <div class="product-info">
                        <h3>Winter Jacket</h3>
                        <p>Seller: FashionQueen</p>
                        <p class="price">$65.00</p>
                    </div>
                </div>

                <div class="order-actions">
                    <button class="cancel-btn" disabled>Cancel Order</button>
                    <button class="report-btn">Report Issue</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Order Modal -->
    <div id="cancelModal" class="modal">
        <div class="modal-content">
            <h2>Cancel Order</h2>
            <p>Are you sure you want to cancel this order?</p>
            <div class="modal-buttons">
                <button id="confirmCancel" class="btn-danger">Yes, Cancel</button>
                <button id="closeCancel" class="btn-secondary">No, Keep It</button>
            </div>
        </div>
    </div>

    <!-- Report Modal -->
    <div id="reportModal" class="modal">
        <div class="modal-content">
            <h2>Report an Issue</h2>
            <textarea placeholder="Please describe the issue..." rows="4"></textarea>
            <div class="modal-buttons">
                <button id="submitReport" class="btn-primary">Submit Report</button>
                <button id="closeReport" class="btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

    <script src="../assets/js/buyer-orders.js"></script>
</body>
</html>