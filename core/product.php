<?php
session_start();
header('Content-Type: application/json');
include_once '../core/db.php';

$response = ['success' => false];

$userId = $_SESSION['user_id'] ?? null;
$mode = $_SESSION['mode'] ?? 'buyer';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        parse_str(file_get_contents("php://input"), $deleteData);
        if ($mode === 'seller' && isset($deleteData['product_id'])) {
            deleteProduct($conn, intval($deleteData['product_id']), $userId, $response);
        } else {
            http_response_code(403);
            $response['error'] = 'Unauthorized or missing product ID';
        }
    } elseif ($mode === 'seller' && $userId) {
        handleSellerData($conn, $userId, $response);
    } elseif (isset($_GET['product_id'])) {
        handleSingleProduct($conn, intval($_GET['product_id']), $response);
    } else {
        handleBuyerProductList($conn, $_GET, $response);
    }
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);

function handleSingleProduct($conn, $productId, &$response) {
    $stmt = $conn->prepare("
        SELECT
            p.product_id,
            p.title,
            p.description,
            p.price,
            p.category,
            p.quantity_available,
            p.is_sold,
            p.image_paths,
            p.post_date,
            CONCAT(u.first_name, ' ', u.last_name) AS seller_name
        FROM Products p
        INNER JOIN Users u ON p.seller_id = u.user_id
        WHERE p.product_id = ?
        LIMIT 1
    ");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $row['image_paths'] = json_decode($row['image_paths'], true) ?? [];
        $response['product'] = $row;
        $response['success'] = true;
    } else {
        $response['error'] = "Product not found.";
    }
}

function handleBuyerProductList($conn, $params, &$response) {
    $category = $params['category'] ?? '';
    $search = $params['search'] ?? '';

    $sql = "
        SELECT
            p.product_id,
            p.category,
            p.title,
            p.price,
            JSON_UNQUOTE(JSON_EXTRACT(p.image_paths, '$[0]')) AS first_image,
            CONCAT(u.first_name, ' ', u.last_name) AS seller_name
        FROM Products p
        INNER JOIN Users u ON p.seller_id = u.user_id
        WHERE p.is_sold = 0
    ";

    $queryParams = [];
    $types = '';

    if (!empty($category)) {
        $sql .= " AND p.category = ?";
        $queryParams[] = $category;
        $types .= 's';
    }

    if (!empty($search)) {
        $sql .= " AND p.title LIKE ?";
        $queryParams[] = "%" . $search . "%";
        $types .= 's';
    }

    $sql .= " ORDER BY CASE p.category
                WHEN 'textbooks' THEN 1
                WHEN 'electronics' THEN 2
                WHEN 'clothing' THEN 3
                WHEN 'OTHERS' THEN 4
                ELSE 5
                END,
                p.post_date DESC";

    $stmt = $conn->prepare($sql);
    if (!empty($queryParams)) {
        $stmt->bind_param($types, ...$queryParams);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    $response['products'] = $products;
    $response['success'] = true;
}

function handleSellerData($conn, $userId, &$response) {
    $productsStmt = $conn->prepare("
        SELECT product_id, title, price, quantity_available, is_sold,
            JSON_UNQUOTE(JSON_EXTRACT(image_paths, '$[0]')) AS first_image
        FROM Products
        WHERE seller_id = ?
    ");
    $productsStmt->bind_param("i", $userId);
    $productsStmt->execute();
    $productsResult = $productsStmt->get_result();

    $products = [];
    while ($row = $productsResult->fetch_assoc()) {
        $row['status'] = $row['is_sold'] ? 'Sold Out' : 'Active';
        unset($row['is_sold']);
        $products[] = $row;
    }

    $totalProductsStmt = $conn->prepare("SELECT COUNT(*) AS total_products FROM Products WHERE seller_id = ?");
    $totalProductsStmt->bind_param("i", $userId);
    $totalProductsStmt->execute();
    $totalProducts = $totalProductsStmt->get_result()->fetch_assoc()['total_products'];

    $pendingOrdersStmt = $conn->prepare("
        SELECT COUNT(*) AS pending_orders
        FROM Orders
        WHERE seller_id = ? AND status = 'pending'
    ");
    $pendingOrdersStmt->bind_param("i", $userId);
    $pendingOrdersStmt->execute();
    $pendingOrders = $pendingOrdersStmt->get_result()->fetch_assoc()['pending_orders'];

    $monthlySalesStmt = $conn->prepare("
        SELECT COUNT(*) AS monthly_sales
        FROM Orders
        WHERE seller_id = ? AND status = 'completed' AND order_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
    ");
    $monthlySalesStmt->bind_param("i", $userId);
    $monthlySalesStmt->execute();
    $monthlySales = $monthlySalesStmt->get_result()->fetch_assoc()['monthly_sales'];

    $response['success'] = true;
    $response['products'] = $products;
    $response['total_products'] = $totalProducts;
    $response['pending_orders'] = $pendingOrders;
    $response['monthly_sales'] = $monthlySales;
}

function deleteProduct($conn, $productId, $sellerId, &$response) {
    $checkStmt = $conn->prepare("SELECT product_id FROM Products WHERE product_id = ? AND seller_id = ?");
    $checkStmt->bind_param("ii", $productId, $sellerId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows === 0) {
        http_response_code(404);
        $response['error'] = 'Product not found or access denied.';
        return;
    }

    $deleteStmt = $conn->prepare("DELETE FROM Products WHERE product_id = ?");
    $deleteStmt->bind_param("i", $productId);
    if ($deleteStmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Product deleted successfully.';
    } else {
        http_response_code(500);
        $response['error'] = 'Failed to delete product.';
    }
}
