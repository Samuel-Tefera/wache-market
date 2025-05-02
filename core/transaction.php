<?php
session_start();
header('Content-Type: application/json');
include_once '../core/db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not authenticated.']);
    exit;
}

$user_id = $_SESSION['user_id'];
$action = $_POST['action'] ?? null;

if ($action === 'deposit' || $action === 'withdrawal') {
    $amount = floatval($_POST['amount'] ?? 0);
    $method = $_POST['method'] ?? null;

    if ($amount <= 0 || !$method) {
        echo json_encode(['success' => false, 'message' => 'Invalid amount or method.']);
        exit;
    }

    $getUser = $conn->prepare("SELECT wallet_balance FROM Users WHERE user_id = ?");
    $getUser->bind_param("i", $user_id);
    $getUser->execute();
    $getUser->bind_result($wallet_balance);
    if (!$getUser->fetch()) {
        echo json_encode(['success' => false, 'message' => 'User not found.']);
        exit;
    }
    $getUser->close();

    if ($action === 'withdrawal' && $wallet_balance < $amount) {
        echo json_encode(['success' => false, 'message' => 'Insufficient funds.']);
        exit;
    }

    // Update wallet balance
    $new_balance = $action === 'deposit' ? $wallet_balance + $amount : $wallet_balance - $amount;
    $update = $conn->prepare("UPDATE Users SET wallet_balance = ? WHERE user_id = ?");
    $update->bind_param("di", $new_balance, $user_id);
    $update->execute();
    $update->close();

    // Insert transaction
    $insert = $conn->prepare("INSERT INTO Transactions (user_id, amount, type, method, status) VALUES (?, ?, ?, ?, 'pending')");
    $insert->bind_param("idss", $user_id, $amount, $action, $method);
    $insert->execute();
    $insert->close();

    echo json_encode(['success' => true, 'message' => ucfirst($action) . ' successful.', 'wallet_balance' => $new_balance]);
    exit;

} elseif ($action === 'purchase') {
    $product_id = intval($_POST['product_id'] ?? 0);
    $method = $_POST['method'] ?? null;

    if (!$product_id || !$method) {
        echo json_encode(['success' => false, 'message' => 'Product or method missing.']);
        exit;
    }

    $product = $conn->prepare("SELECT price, seller_id FROM Products WHERE product_id = ?");
    $product->bind_param("i", $product_id);
    $product->execute();
    $product->bind_result($price, $seller_id);
    if (!$product->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Product not found.']);
        exit;
    }
    $product->close();

    if ($seller_id == $user_id) {
        echo json_encode(['success' => false, 'message' => 'You cannot buy your own product.']);
        exit;
    }

    $buyer = $conn->prepare("SELECT wallet_balance FROM Users WHERE user_id = ?");
    $buyer->bind_param("i", $user_id);
    $buyer->execute();
    $buyer->bind_result($buyer_balance);
    if (!$buyer->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Buyer not found.']);
        exit;
    }
    $buyer->close();

    if ($buyer_balance < $price) {
        echo json_encode(['success' => false, 'message' => 'Insufficient funds.']);
        exit;
    }

    // Begin transaction
    $conn->begin_transaction();
    try {
        // Deduct from buyer
        $update_buyer = $conn->prepare("UPDATE Users SET wallet_balance = wallet_balance - ? WHERE user_id = ?");
        $update_buyer->bind_param("di", $price, $user_id);
        $update_buyer->execute();

        // Add to seller
        $update_seller = $conn->prepare("UPDATE Users SET wallet_balance = wallet_balance + ? WHERE user_id = ?");
        $update_seller->bind_param("di", $price, $seller_id);
        $update_seller->execute();

        // Insert buyer transaction
        $buyer_txn = $conn->prepare("INSERT INTO Transactions (user_id, amount, type, method, status, related_product_id) VALUES (?, ?, 'purchase', ?, 'pending', ?)");
        $buyer_txn->bind_param("idssi", $user_id, $price, $method, $product_id);
        $buyer_txn->execute();

        // Insert seller transaction
        $seller_txn = $conn->prepare("INSERT INTO Transactions (user_id, amount, type, method, status, related_product_id) VALUES (?, ?, 'sale', ?, 'pending', ?)");
        $seller_txn->bind_param("idssi", $seller_id, $price, $method, $product_id);
        $seller_txn->execute();

        $conn->commit();

        echo json_encode(['success' => true, 'message' => 'Purchase successful.']);
        exit;

    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Transaction failed.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit;
}
?>
