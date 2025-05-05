<?php
include_once '../core/auth.php';
require_auth('admin');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reports - Wache-Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/seller-home.css">
    <link rel="stylesheet" href="../assets/css/admin-dashboard.css">
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

    <div class="admin-container">
        <div class="admin-header">
            <h1>Report Management <span class="badge" id="reportCount"></span></h1>
            <div class="filter-controls">
                <select id="filterStatus">
                    <option value="all">All Reports</option>
                    <option value="pending">Pending Only</option>
                    <option value="resolved">Resolved Only</option>
                </select>
            </div>
        </div>

        <div class="reports-list">

        </div>
    </div>

    <div id="resolveModal" class="modal">
        <div class="modal-content">
            <h2>Mark Report as Resolved?</h2>
            <p>This will close the report and notify both parties.</p>
            <div class="modal-buttons">
                <button id="confirmResolve" class="btn-primary">Confirm</button>
                <button id="cancelResolve" class="btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

    <div id="contactModal" class="modal">
        <div class="modal-content">
            <h2>Contact Information</h2>

            <div class="contact-section">
                <h3>Buyer Details</h3>
                <div class="contact-info">
                    <p><strong>Name:</strong> <span id="buyerName">John Doe</span></p>
                    <p><strong>Email:</strong> <span id="buyerEmail">buyer123@example.com</span></p>
                    <p><strong>Phone:</strong> <span id="buyerPhone">(555) 123-4567</span></p>
                    <p><strong>Address:</strong> <span id="buyerAddress">Block B, Dorm 305</span></p>
                </div>
            </div>

            <div class="contact-section">
                <h3>Seller Details</h3>
                <div class="contact-info">
                    <p><strong>Name:</strong> <span id="sellerName">Jane Smith</span></p>
                    <p><strong>Email:</strong> <span id="sellerEmail">seller456@example.com</span></p>
                    <p><strong>Phone:</strong> <span id="sellerPhone">(555) 987-6543</span></p>
                    <p><strong>Address:</strong> <span id="sellerAddress">Block D, Dorm 112</span></p>
                </div>
            </div>

            <div class="modal-buttons">
                <button id="closeContact" class="btn-secondary">Close</button>
            </div>
        </div>
    </div>

    <script src="../assets/js/admin-dashboard.js"></script>
</body>

</html>