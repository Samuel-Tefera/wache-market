<?php
require_once 'envloader.php';
loadEnv(__DIR__ . '/../.env');

$host = $_ENV['DB_HOST'];
$db   = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo "Not connected";
    die("Connection failed: " . $conn->connect_error);
}

?>
