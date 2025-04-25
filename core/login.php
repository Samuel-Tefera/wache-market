<?php
session_start();
header('Content-Type: application/json');
include_once 'db.php';

$response = ['success' => false, 'message' => 'Invalid credentials'];

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    $response['message'] = 'Please enter both email and password';
    echo json_encode($response);
    exit;
}

$stmt = $conn->prepare("SELECT user_id, password_hash, current_mode FROM Users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $user = $result->fetch_assoc()) {
    if (password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['mode'] = $user['current_mode'];

        $response['success'] = true;
        $response['mode'] = $user['current_mode'];
        $response['message'] = 'Login successful';
    }
}

echo json_encode($response);
