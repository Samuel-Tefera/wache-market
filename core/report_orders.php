<?php
include_once '../core/db.php';

header('Content-Type: application/json');
session_start();

$method = $_SERVER['REQUEST_METHOD'];


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['report_id'])) {

    $report_id = $_GET['report_id'];

    $stmt = $conn->prepare("SELECT buyer_id, seller_id FROM order_reports WHERE report_id = ?");
    $stmt->bind_param("s", $report_id);
    $stmt->execute();
    $stmt->bind_result($buyer_id, $seller_id);

    if ($stmt->fetch()) {
        $stmt->close();

        $buyerStmt = $conn->prepare("SELECT first_name, last_name, email, phone_number, address FROM users WHERE user_id = ?");
        $buyerStmt->bind_param("i", $buyer_id);
        $buyerStmt->execute();
        $buyerStmt->bind_result($bFirst, $bLast, $bEmail, $bPhone, $bAddress);
        $buyerStmt->fetch();
        $buyerStmt->close();

        $sellerStmt = $conn->prepare("SELECT first_name, last_name, email, phone_number, address FROM users WHERE user_id = ?");
        $sellerStmt->bind_param("i", $seller_id);
        $sellerStmt->execute();
        $sellerStmt->bind_result($sFirst, $sLast, $sEmail, $sPhone, $sAddress);
        $sellerStmt->fetch();
        $sellerStmt->close();

        echo json_encode([
            'buyerInfo' => [
                'full_name' => "$bFirst $bLast",
                'email' => $bEmail,
                'phone' => $bPhone,
                'address' => $bAddress
            ],
            'sellerInfo' => [
                'full_name' => "$sFirst $sLast",
                'email' => $sEmail,
                'phone' => $sPhone,
                'address' => $sAddress
            ]
        ]);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Report not found']);
    }

    exit;
}


if ($method === 'POST') {
    $order_id = $_POST['order_id'] ?? '';
    $report_text = $_POST['report_text'] ?? '';
    $buyer_id = $_SESSION['user_id'] ?? null;

    if (empty($order_id) || empty($report_text)) {
        echo json_encode(['error' => 'Order ID and report text are required.']);
        exit;
    }

    $stmt = $conn->prepare("SELECT seller_id FROM products WHERE product_id = (SELECT product_id FROM orders WHERE order_id = ?)");
    $stmt->bind_param("s", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['error' => 'Order not found or seller missing.']);
        exit;
    }

    $seller_id = $result->fetch_assoc()['seller_id'];
    $report_id = uniqid();

    $insert = $conn->prepare("INSERT INTO order_reports (report_id, order_id, buyer_id, seller_id, report_text) VALUES (?, ?, ?, ?, ?)");
    $insert->bind_param("ssiis", $report_id, $order_id, $buyer_id, $seller_id, $report_text);

    if ($insert->execute()) {
        echo json_encode(['success' => true, 'message' => 'Report submitted.']);
    } else {
        echo json_encode(['error' => 'Failed to submit report.']);
    }
    exit;
}

if ($method === 'GET') {
    if ($_SESSION['mode'] !== 'admin') {
        echo json_encode(['error' => 'Unauthorized access.']);
        exit;
    }

    $reportQuery = "
        SELECT
            r.report_id,
            r.order_id,
            r.buyer_id,
            r.seller_id,
            r.report_text,
            r.created_at,
            r.is_resolved,
            CONCAT(b.first_name, ' ', b.last_name) AS buyer_name,
            CONCAT(s.first_name, ' ', s.last_name) AS seller_name
        FROM order_reports r
        JOIN users b ON r.buyer_id = b.user_id
        JOIN users s ON r.seller_id = s.user_id
        ORDER BY r.created_at DESC
    ";
    $reportResult = $conn->query($reportQuery);

    $reports = [];
    while ($row = $reportResult->fetch_assoc()) {
        $reports[] = $row;
    }

    $countQuery = "SELECT COUNT(*) AS unresolved_count FROM order_reports WHERE is_resolved = FALSE";
    $countResult = $conn->query($countQuery);
    $unresolvedCount = $countResult->fetch_assoc()['unresolved_count'] ?? 0;

    echo json_encode([
        'reports' => $reports,
        'unresolved_count' => $unresolvedCount
    ]);
    exit;
}

if ($method === 'PUT') {
    if ($_SESSION['mode'] !== 'admin') {
        echo json_encode(['error' => 'Unauthorized access.']);
        exit;
    }

    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    $report_id = $data['report_id'] ?? null;

    if (empty($report_id)) {
        echo json_encode(['error' => 'Missing report ID.']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE order_reports SET is_resolved = TRUE WHERE report_id = ?");
    $stmt->bind_param("s", $report_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Report marked as resolved.']);
    } else {
        echo json_encode(['error' => 'Failed to update report.']);
    }
    exit;
}

echo json_encode(['error' => 'Invalid request method.']);
exit; ?>