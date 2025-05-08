<?php
header('Content-Type: application/json');
session_start();
require_once 'db.php';

$response = ['success' => false];

if (!isset($_SESSION['user_id'])) {
    $response['error'] = 'User not authenticated';
    echo json_encode($response);
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "
        SELECT
            p.product_id,
            p.title,
            p.price,
            JSON_UNQUOTE(JSON_EXTRACT(p.image_paths, '$[0]')) AS first_image,
            c.quantity
        FROM cart c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.user_id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $cartItems = [];
    $subtotal = 0;

    while ($row = $result->fetch_assoc()) {
        $row['total_price'] = $row['price'] * $row['quantity'];
        $subtotal += $row['total_price'];
        $cartItems[] = $row;
    }

    $response['success'] = true;
    $response['items'] = $cartItems;
    $response['subtotal'] = $subtotal;
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : null;

    if (!$product_id) {
        $response['error'] = 'Product ID is required';
        echo json_encode($response);
        exit;
    }

    $checkStmt = $conn->prepare("SELECT cart_item_id FROM cart WHERE user_id = ? AND product_id = ?");
    $checkStmt->bind_param("ii", $user_id, $product_id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $response['error'] = 'Product already in cart';
        echo json_encode($response);
        exit;
    }

    $insertStmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)");
    $insertStmt->bind_param("ii", $user_id, $product_id);

    if ($insertStmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Product added to cart';
    } else {
        $response['error'] = 'Failed to add product to cart';
    }

    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $deleteData);
    $product_id = isset($deleteData['product_id']) ? intval($deleteData['product_id']) : null;

    if (!$product_id) {
        $response['error'] = 'Product ID is required for deletion';
        echo json_encode($response);
        exit;
    }

    $deleteStmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
    $deleteStmt->bind_param("ii", $user_id, $product_id);

    if ($deleteStmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Product removed from cart';
    } else {
        $response['error'] = 'Failed to remove product';
    }

    echo json_encode($response);
    exit;
}
