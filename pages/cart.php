<?php
include_once '../core/auth.php';
require_auth('buyer');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Wache-Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/seller-home.css">
    <link rel="stylesheet" href="../assets/css/cart.css">
</head>
<body>
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
                    <li><a href="buyer-home.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                    <li><a  class="active" href="cart.php"><i class="fas fa-clipboard-list"></i> Cart</a></li>
                    <li><a href="buyer-orders.php"><i class="fas fa-clipboard-list"></i> Orders</a></li>
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
    <main class="cart-container">

    </main>

    <!-- Confirmation Modal -->
    <div class="modal-overlay hidden">
        <div class="confirmation-modal">
            <h3>Are you sure?</h3>
            <p>Do you want to proceed with checkout?</p>
            <div class="modal-actions">
                <button class="cancel-btn">Cancel</button>
                <button class="confirm-btn">Confirm</button>
            </div>
        </div>
    </div>

    <script src="../assets/js/cart.js"></script>
</body>
</html>