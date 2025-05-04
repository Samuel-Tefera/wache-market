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