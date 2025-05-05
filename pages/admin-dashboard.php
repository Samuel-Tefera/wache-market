<?php
include_once '../core/auth.php';
require_auth('admin');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reports - Watche-Market</title>
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
            <h1>Report Management <span class="badge" id="reportCount">3</span></h1>
            <div class="filter-controls">
                <select id="filterStatus">
                    <option value="all">All Reports</option>
                    <option value="pending">Pending Only</option>
                    <option value="resolved">Resolved Only</option>
                </select>
            </div>
        </div>

        <div class="reports-list">
            <!-- Report 1 -->
            <div class="report-card" data-status="pending">
                <div class="report-header">
                    <span class="report-id">REPORT #WE789456</span>
                    <span class="report-date">Oct 15, 2023</span>
                    <span class="report-status">Pending</span>
                </div>

                <div class="report-details">
                    <div class="user-info">
                        <p><strong>From:</strong> buyer123 (Buyer)</p>
                        <p><strong>Against:</strong> seller456 (Seller)</p>
                        <p><strong>Order:</strong> #WE235689</p>
                    </div>

                    <div class="report-content">
                        <h3>Issue Reported</h3>
                        <p>The product I received was not as described. The textbook is missing several chapters that
                            were supposed to be included according to the listing.</p>
                    </div>
                </div>

                <div class="report-actions">
                    <button class="resolve-btn">Mark as Resolved</button>
                    <button class="contact-btn">Contact Users</button>
                </div>
            </div>

            <!-- Report 2 -->
            <div class="report-card" data-status="pending">
                <div class="report-header">
                    <span class="report-id">REPORT #WE123654</span>
                    <span class="report-date">Oct 10, 2023</span>
                    <span class="report-status">Pending</span>
                </div>

                <div class="report-details">
                    <div class="user-info">
                        <p><strong>From:</strong> student2023 (Buyer)</p>
                        <p><strong>Against:</strong> techguru (Seller)</p>
                        <p><strong>Order:</strong> #WE874562</p>
                    </div>

                    <div class="report-content">
                        <h3>Issue Reported</h3>
                        <p>The wireless earbuds arrived damaged. The right earbud doesn't work at all, and there was no
                            protective packaging in the shipment.</p>
                    </div>
                </div>

                <div class="report-actions">
                    <button class="resolve-btn">Mark as Resolved</button>
                    <button class="contact-btn">Contact Users</button>
                </div>
            </div>

            <!-- Report 3 -->
            <div class="report-card" data-status="resolved">
                <div class="report-header">
                    <span class="report-id">REPORT #WE456123</span>
                    <span class="report-date">Oct 5, 2023</span>
                    <span class="report-status">Resolved</span>
                </div>

                <div class="report-details">
                    <div class="user-info">
                        <p><strong>From:</strong> newuser99 (Buyer)</p>
                        <p><strong>Against:</strong> fashionqueen (Seller)</p>
                        <p><strong>Order:</strong> #WE124578</p>
                    </div>

                    <div class="report-content">
                        <h3>Issue Reported</h3>
                        <p>The jacket had a small tear that wasn't visible in the product photos. Seller agreed to
                            partial refund.</p>
                    </div>
                </div>

                <div class="report-actions">
                    <button class="resolve-btn" disabled>Resolved</button>
                    <button class="contact-btn">View Conversation</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Resolve Confirmation Modal -->
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
    <!-- Add this modal after the existing resolve modal -->
    <!-- Contact Users Modal -->
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