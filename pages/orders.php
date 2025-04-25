<?php
include_once '../core/auth.php';
require_auth('seller');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Wache-Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/seller-home.css">
    <link rel="stylesheet" href="../assets/css/orders.css">
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
                    <li><a href="seller-home.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                    <li><a href="orders.php"  class="active"><i class="fas fa-clipboard-list"></i> Orders</a></li>
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
    <main class="orders-container">
        <h1>My Product Orders</h1>

        <!-- Order Filters -->
        <div class="order-filters">
            <select id="status-filter">
                <option value="all">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
            </select>
            <input type="text" id="search-orders" placeholder="Search orders...">
        </div>

        <!-- Orders List -->
        <div class="orders-list">
            <!-- Order 1 -->
            <div class="order-card pending">
                <div class="order-header">
                    <span class="order-id">#ORD-2023-001</span>
                    <span class="order-date">Nov 15, 2023</span>
                    <span class="order-status">Pending</span>
                </div>

                <div class="order-details">
                    <div class="product-info">
                        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=100&q=80"
                             alt="Engineering Textbook">
                        <div>
                            <h3>Engineering Mathematics</h3>
                            <p>ETB 350 × 1</p>
                        </div>
                    </div>

                    <div class="buyer-info">
                        <p><i class="fas fa-user"></i> <strong>John Doe</strong></p>
                        <p><i class="fas fa-map-marker-alt"></i> Dormitory B, Room 12, Wachemo University</p>
                    </div>
                </div>

                <div class="order-actions">
                    <button class="status-btn mark-processing">
                        <i class="fas fa-spinner"></i> Mark as Processing
                    </button>
                </div>
            </div>

            <!-- Order 2 -->
            <div class="order-card processing">
                <div class="order-header">
                    <span class="order-id">#ORD-2023-002</span>
                    <span class="order-date">Nov 14, 2023</span>
                    <span class="order-status">Processing</span>
                </div>

                <div class="order-details">
                    <div class="product-info">
                        <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=100&q=80"
                             alt="Laptop">
                        <div>
                            <h3>Dell Laptop i5</h3>
                            <p>ETB 12,500 × 1</p>
                        </div>
                    </div>

                    <div class="buyer-info">
                        <p><i class="fas fa-user"></i> <strong>Sarah Smith</strong></p>
                        <p><i class="fas fa-map-marker-alt"></i> Off-campus, 22 College Street</p>
                    </div>
                </div>

                <div class="order-actions">
                    <button class="status-btn mark-shipped">
                        <i class="fas fa-truck"></i> Mark as Shipped
                    </button>
                </div>
            </div>

            <!-- Order 3 -->
            <div class="order-card shipped">
                <div class="order-header">
                    <span class="order-id">#ORD-2023-003</span>
                    <span class="order-date">Nov 10, 2023</span>
                    <span class="order-status">Shipped</span>
                </div>

                <div class="order-details">
                    <div class="product-info">
                        <img src="https://images.unsplash.com/photo-1541963463532-d68292c34b19?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=100&q=80"
                             alt="Chemistry Textbook">
                        <div>
                            <h3>Chemistry Fundamentals</h3>
                            <p>ETB 280 × 2</p>
                        </div>
                    </div>

                    <div class="buyer-info">
                        <p><i class="fas fa-user"></i> <strong>Michael Johnson</strong></p>
                        <p><i class="fas fa-map-marker-alt"></i> Main Campus, Lecturer Quarters</p>
                    </div>
                </div>

                <div class="order-actions">
                    <button class="status-btn mark-delivered">
                        <i class="fas fa-check-circle"></i> Mark as Delivered
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script src="../assets/js/orders.js"></script>
</body>
</html>