<?php
header('Content-Type: application/json');
include_once '../core/db.php';

$response = ['success' => false];

try {
    if (isset($_GET['product_id'])) {
        $productId = intval($_GET['product_id']);

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

    } else {
        $categoryFilter = isset($_GET['category']) ? trim($_GET['category']) : '';
        $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

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

        $params = [];
        $types = '';

        if ($categoryFilter !== '') {
            $sql .= " AND p.category = ?";
            $params[] = $categoryFilter;
            $types .= 's';
        }

        if ($searchQuery !== '') {
            $sql .= " AND p.title LIKE ?";
            $params[] = "%" . $searchQuery . "%";
            $types .= 's';
        }

        $sql .= " ORDER BY p.post_date DESC";

        $stmt = $conn->prepare($sql);

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
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

} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);
