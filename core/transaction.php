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
    $insert = $conn->prepare("INSERT INTO Transactions (user_id, amount, type, method, status) VALUES (?, ?, ?, ?, 'completed')");
    $insert->bind_param("idss", $user_id, $amount, $action, $method);
    $insert->execute();
    $insert->close();

    echo json_encode(['success' => true, 'message' => ucfirst($action) . ' successful.', 'wallet_balance' => $new_balance]);
    exit;
}
?>
