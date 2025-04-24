<?php
header('Content-Type: application/json');
include_once 'db.php';

$response = ['success' => false, 'message' => 'Something went wrong'];

// Required fields (you've already validated them in JS)
$firstName = $_POST['firstName'] ?? '';
$lastName  = $_POST['lastName'] ?? '';
$email     = $_POST['email'] ?? '';
$phone     = $_POST['phone'] ?? '';
$password  = $_POST['password'] ?? '';
$mode      = $_POST['mode'] ?? 'buyer';
$address   = $_POST['address'] ?? '';

if (empty($email) || empty($password)) {
    $response['message'] = 'Missing required data';
    echo json_encode($response);
    exit;
}

// Check if email already exists
$emailCheck = $conn->prepare("SELECT user_id FROM Users WHERE email = ?");
$emailCheck->bind_param("s", $email);
$emailCheck->execute();
$emailCheck->store_result();

if ($emailCheck->num_rows > 0) {
    $response['message'] = 'Email is already registered';
    echo json_encode($response);
    exit;
}
$emailCheck->close();

// Hash password
$hash = password_hash($password, PASSWORD_DEFAULT);

// Profile image upload (if exists)
$profilePath = null;

if (isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    $mimeType = mime_content_type($_FILES['profile']['tmp_name']);

    if (in_array($mimeType, $allowedTypes)) {
        $ext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
        $newName = 'user_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
        $uploadPath = '../uploads/profiles/' . $newName;

        if (move_uploaded_file($_FILES['profile']['tmp_name'], $uploadPath)) {
            $profilePath = 'uploads/profiles/' . $newName;
        } else {
            $response['message'] = 'Failed to upload profile image';
            echo json_encode($response);
            exit;
        }
    } else {
        $response['message'] = 'Invalid file type for profile image';
        echo json_encode($response);
        exit;
    }
}

// Insert user
$stmt = $conn->prepare("INSERT INTO Users (first_name, last_name, email, phone_number, password_hash, current_mode, profile_link_url, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $firstName, $lastName, $email, $phone, $hash, $mode, $profilePath, $address);

if ($stmt->execute()) {
    session_start();
    $_SESSION['user_id'] = $conn->insert_id;
    $_SESSION['mode'] = $_POST['mode'] ?? 'buyer'; // capture mode from form
    $response['success'] = true;
    $response['message'] = 'User created and logged in successfully';
} else {
    $response['message'] = 'Database error: ' . $stmt->error;
}

$stmt->close();
echo json_encode($response);
