<?php
$host = 'localhost';
$db   = 'wache-market';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo "Not connected";
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully";
?>
