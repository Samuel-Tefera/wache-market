<?php
include_once '../core/auth.php';
require_auth('seller');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Wache Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/product.css">
    <link rel="stylesheet" href="../assets/css/add-product.css">
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
            <a href="index.html" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Home</a>
        </nav>
    </header>
    <div class="container">
        <h2>Add New Product</h2>
        <form id="productForm">
            <div class="form-group">
                <label for="title">Title*</label>
                <input name="title" type="text" id="title" required maxlength="100">
                <div class="error" id="title-error"></div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="3"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price*</label>
                    <input name="price" type="number" id="price" min="0" step="0.01" required>
                    <div class="error" id="price-error"></div>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity*</label>
                    <input name="quantity" type="number" id="quantity" min="1" value="1" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="category">Category*</label>
                    <select name="category" id="category" required>
                        <option value="">Select...</option>
                        <option value="textbooks">Books</option>
                        <option value="electronics">Electronics</option>
                        <option value="clothing">Clothing</option>
                        <option value="furniture">Furniture</option>
                        <option value="other">Other</option>
                    </select>
                    <div class="error" id="category-error"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="images">Images (Max 5)*</label>
                <input name="images[]" type="file" id="images" multiple accept="image/*" required>
                <div class="error" id="images-error"></div>
                <div id="image-preview"></div>
            </div>
            <div class="error" id="general-error"></div>
            <button type="submit">Add Product</button>
        </form>
    </div>

    <div class="modal" id="successModal">
        <div class="modal-content">
            <h3>Success!</h3>
            <p>Your product has been listed.</p>
            <div class="modal-buttons">
                <button id="addAnother">Add Another</button>
                <button id="backToDashboard">Done</button>
            </div>
        </div>
    </div>
    <script src="../assets/js/add-product.js"></script>
</body>
</html>
