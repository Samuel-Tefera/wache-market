<?php
header('Content-Type: application/json');
session_start();
require_once 'db.php';

$response = ['success' => false];

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $response['error'] = 'User not authenticated';
    echo json_encode($response);
    ob_end_clean();
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : null;

if (!$product_id) {
    $response['error'] = 'Product ID is required';
    echo json_encode($response);
    exit;
}

// Check if product is already in user's cart
$checkStmt = $conn->prepare("SELECT cart_item_id FROM cart WHERE user_id = ? AND product_id = ?");
$checkStmt->bind_param("ii", $user_id, $product_id);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    $response['error'] = 'Product already in cart';
    echo json_encode($response);
    exit;
}

// Insert product into cart
$insertStmt = $conn->prepare("INSERT INTO cart (user_id, product_id) VALUES (?, ?)");
$insertStmt->bind_param("ii", $user_id, $product_id);

if ($insertStmt->execute()) {
    $response['success'] = true;
    $response['message'] = 'Product added to cart';
} else {
    $response['error'] = 'Failed to add product to cart';
}

echo json_encode($response);
exit;
