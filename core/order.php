<?php
header('Content-Type: application/json');
session_start();
require_once 'db.php';

$response = ['success' => false];

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not authenticated']);
    exit;
}

$buyer_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

$product_ids = isset($_POST['product_ids']) ? $_POST['product_ids'] : [];
$total_amount = isset($_POST['total_amount']) ? floatval($_POST['total_amount']) : 0;


if (empty($product_ids) || $total_amount <= 0) {
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

// Fetch buyer wallet balance and delivery location
$userQuery = $conn->prepare("SELECT wallet_balance, address FROM users WHERE user_id = ?");
$userQuery->bind_param("i", $buyer_id);
$userQuery->execute();
$userResult = $userQuery->get_result();

if ($userResult->num_rows === 0) {
    echo json_encode(['error' => 'User not found']);
    exit;
}

$userData = $userResult->fetch_assoc();

if ($userData['wallet_balance'] < $total_amount) {
    echo json_encode(['error' => 'Insufficient wallet balance']);
    exit;
}

$delivery_location = $userData['address'];

// Begin transaction
$conn->begin_transaction();

try {
    foreach ($product_ids as $product_id) {
        // Fetch seller_id and price from product
        $productStmt = $conn->prepare("SELECT seller_id AS seller_id, price FROM products WHERE product_id = ?");
        $productStmt->bind_param("i", $product_id);
        $productStmt->execute();
        $productResult = $productStmt->get_result();

        if ($productResult->num_rows === 0) {
            throw new Exception("Product not found: ID $product_id");
        }

        $productData = $productResult->fetch_assoc();
        $seller_id = $productData['seller_id'];
        $price = $productData['price'];
        $order_id = uniqid();

        // Insert into orders
        $orderStmt = $conn->prepare("
            INSERT INTO orders (order_id, seller_id, buyer_id, product_id, payment_method, delivery_location)
            VALUES (?, ?, ?, ?, 'app wallet', ?)
        ");
        $orderStmt->bind_param("siiis", $order_id, $seller_id, $buyer_id, $product_id, $delivery_location);
        $orderStmt->execute();

        // Record transaction for buyer (purchase)
        $buyerTxn = $conn->prepare("
            INSERT INTO transactions (user_id, amount, type, method, related_product_id, status)
            VALUES (?, ?, 'purchase', 'app wallet', ?, 'completed')
        ");
        $buyerTxn->bind_param("idi", $buyer_id, $price, $product_id);
        $buyerTxn->execute();

        // Record transaction for seller (sale)
        $sellerTxn = $conn->prepare("
            INSERT INTO transactions (user_id, amount, type, method, related_product_id, status)
            VALUES (?, ?, 'sale', 'app wallet', ?, 'completed')
        ");
        $sellerTxn->bind_param("idi", $seller_id, $price, $product_id);
        $sellerTxn->execute();

        // Update seller wallet
        $conn->query("UPDATE users SET wallet_balance = wallet_balance + $price WHERE user_id = $seller_id");
    }

    // Deduct total from buyer wallet
    $conn->query("UPDATE users SET wallet_balance = wallet_balance - $total_amount WHERE user_id = $buyer_id");

    // Clear user's cart
    $deleteCart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $deleteCart->bind_param("i", $buyer_id);
    $deleteCart->execute();

    $conn->commit();
    $response['success'] = true;
    $response['message'] = 'Order placed successfully';
} catch (Exception $e) {
    $conn->rollback();
    $response['error'] = 'Transaction failed: ' . $e->getMessage();
}

echo json_encode($response);
