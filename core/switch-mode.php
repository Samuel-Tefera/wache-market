<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$user_id = $_SESSION['user_id'];
$new_mode = $_POST['mode'] ?? '';

if (!in_array($new_mode, ['buyer', 'seller'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid mode']);
    exit;
}

$stmt = $conn->prepare("SELECT current_mode FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($current_mode);
$stmt->fetch();
$stmt->close();

if ($current_mode === 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Admins cannot switch modes']);
    exit;
}

$updateStmt = $conn->prepare("UPDATE users SET current_mode = ? WHERE user_id = ?");
$updateStmt->bind_param("si", $new_mode, $user_id);
$success = $updateStmt->execute();
$updateStmt->close();

if ($success) {
    $_SESSION['mode'] = $new_mode;
    echo json_encode(['success' => true, 'new_mode' => $new_mode]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to update mode']);
}
