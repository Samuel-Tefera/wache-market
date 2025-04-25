<?php
include_once '../core/auth.php';
require_auth('seller');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - WatchE-Market</title>
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
                <input type="text" id="title" required maxlength="100">
                <div class="error" id="title-error"></div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" rows="3"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price*</label>
                    <input type="number" id="price" min="0" step="0.01" required>
                    <div class="error" id="price-error"></div>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity*</label>
                    <input type="number" id="quantity" min="1" value="1" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="category">Category*</label>
                    <select id="category" required>
                        <option value="">Select...</option>
                        <option value="textbooks">Textbooks</option>
                        <option value="electronics">Electronics</option>
                        <option value="clothing">Clothing</option>
                        <option value="furniture">Furniture</option>
                        <option value="other">Other</option>
                    </select>
                    <div class="error" id="category-error"></div>
                </div>

                <div class="form-group">
                    <label for="condition">Condition*</label>
                    <select id="condition" required>
                        <option value="">Select...</option>
                        <option value="new">New</option>
                        <option value="used - like new">Used - Like New</option>
                        <option value="used - good">Used - Good</option>
                        <option value="used - fair">Used - Fair</option>
                    </select>
                    <div class="error" id="condition-error"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="images">Images (Max 5)*</label>
                <input type="file" id="images" multiple accept="image/*" required>
                <div class="error" id="images-error"></div>
                <div id="image-preview"></div>
            </div>

            <button type="submit">List Product</button>
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