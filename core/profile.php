<?php
header('Content-Type: application/json');
session_start();
include_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['user_id'];

$userStmt = $conn->prepare("SELECT first_name, last_name, email, phone_number, current_mode, address, wallet_balance, profile_link_url FROM Users WHERE user_id = ?");
$userStmt->bind_param("i", $userId);
$userStmt->execute();
$userResult = $userStmt->get_result();
$userInfo = $userResult->fetch_assoc();
$userStmt->close();

$transactionStmt = $conn->prepare("SELECT amount, method, type, status, transaction_date FROM Transactions WHERE user_id = ? ORDER BY transaction_date DESC");
$transactionStmt->bind_param("i", $userId);
$transactionStmt->execute();
$transactionResult = $transactionStmt->get_result();
$transactions = [];

while ($row = $transactionResult->fetch_assoc()) {
    $transactions[] = $row;
}
$transactionStmt->close();

echo json_encode([
    'success' => true,
    'user' => $userInfo,
    'transactions' => $transactions
]);
