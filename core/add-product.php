<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

include_once 'db.php';

$response = ['success' => false, 'message' => 'Something went wrong'];

$sellerId = $_SESSION['user_id'];
$title    = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$price    = $_POST['price'] ?? 0;
$category = $_POST['category'] ?? '';
$quantity = $_POST['quantity'] ?? 1;

if (empty($title) || empty($description) || empty($price) || empty($category) || empty($quantity)) {
    $response['message'] = 'Please fill all required fields';
    echo json_encode($response);
    exit;
}

$imagePaths = [];

if (!empty($_FILES['images']['name'][0])) {
    $totalFiles = count($_FILES['images']['name']);

    if ($totalFiles > 5 || $totalFiles <= 0) {
        $response['message'] = 'You can upload 1 up to 5 images only.';
        echo json_encode($response);
        exit;
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

    for ($i = 0; $i < $totalFiles; $i++) {
        $fileType = $_FILES['images']['type'][$i];
        $tmpName  = $_FILES['images']['tmp_name'][$i];
        $error    = $_FILES['images']['error'][$i];

        if ($error === UPLOAD_ERR_OK && in_array($fileType, $allowedTypes)) {
            $ext = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
            $newName = 'product_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
            $uploadPath = '../uploads/product-images/' . $newName;

            if (move_uploaded_file($tmpName, $uploadPath)) {
                $imagePaths[] = 'uploads/product-images/' . $newName;
            }
        }
    }
}

$imagePathsJson = json_encode($imagePaths);

$stmt = $conn->prepare("INSERT INTO Products (seller_id, title, description, price, category, quantity_available, image_paths) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issdsis", $sellerId, $title, $description, $price, $category, $quantity, $imagePathsJson);

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = 'Product added successfully';
} else {
    $response['message'] = 'Database error: ' . $stmt->error;
}

$stmt->close();
echo json_encode($response);
