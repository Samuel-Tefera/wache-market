<?php
include_once '../core/auth.php';
require_auth('buyer');
?>

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
            <a href="buyer-home.php" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Home</a>
        </nav>
    </header>
    <main class="product-container">

    </main>

    <script src="../assets/js/product.js"></script>
</body>
</html>