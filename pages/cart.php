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
    <main class="cart-container">
        <h1 class="cart-title">Your Cart</h1>

        <!-- Cart Items List -->
        <div class="cart-items">
            <!-- Product 1 -->
            <div class="cart-item">
                <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80"
                     alt="Engineering Textbook" class="product-image">
                <div class="product-info">
                    <h3>Engineering Mathematics</h3>
                    <p class="product-price">ETB 350</p>
                    <div class="product-actions">
                        <a href="product-detail.html" class="detail-btn">See Details</a>
                        <button class="remove-btn">Remove</button>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="cart-item">
                <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80"
                     alt="Laptop" class="product-image">
                <div class="product-info">
                    <h3>Dell Laptop i5</h3>
                    <p class="product-price">ETB 12,500</p>
                    <div class="product-actions">
                        <a href="product-detail.html" class="detail-btn">See Details</a>
                        <button class="remove-btn">Remove</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <div class="summary-row">
                <span>Subtotal:</span>
                <span>ETB 12,850</span>
            </div>
            <div class="summary-row">
                <span>Delivery Fee:</span>
                <span>ETB 0</span>
            </div>
            <div class="summary-row total">
                <span>Total:</span>
                <span>ETB 12,850</span>
            </div>
        </div>

        <!-- Checkout Button -->
        <button class="checkout-btn">Proceed to Checkout</button>
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