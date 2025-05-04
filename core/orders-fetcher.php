<?php
header('Content-Type: application/json');
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not authenticated']);
    exit;
}

$user_id = $_SESSION['user_id'];
$type = isset($_GET['type']) ? $_GET['type'] : '';

if (!in_array($type, ['buyer', 'seller'])) {
    echo json_encode(['error' => 'Invalid type parameter']);
    exit;
}

$response = [];

if ($type === 'buyer') {
    $stmt = $conn->prepare("SELECT o.order_id, o.product_id, o.seller_id, o.order_date, o.status,
                                   p.title, p.price, JSON_UNQUOTE(JSON_EXTRACT(p.image_paths, '$[0]')) AS first_image,
                                   CONCAT(u.first_name, ' ', u.last_name) AS seller_name
                            FROM orders o
                            JOIN products p ON o.product_id = p.product_id
                            JOIN users u ON o.seller_id = u.user_id
                            WHERE o.buyer_id = ?
                            ORDER BY o.order_date DESC");
    $stmt->bind_param("i", $user_id);
} else {
    $stmt = $conn->prepare("SELECT o.order_id, o.product_id, o.buyer_id, o.order_date, o.delivery_location, o.status,
                                   p.title, p.price, JSON_UNQUOTE(JSON_EXTRACT(p.image_paths, '$[0]')) AS first_image,
                                   CONCAT(u.first_name, ' ', u.last_name) AS buyer_name
                            FROM orders o
                            JOIN products p ON o.product_id = p.product_id
                            JOIN users u ON o.buyer_id = u.user_id
                            WHERE o.seller_id = ?
                            ORDER BY o.order_date DESC");
    $stmt->bind_param("i", $user_id);
}

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $response[] = $row;
}

echo json_encode(['success' => true, 'orders' => $response]);
