<?php
function require_auth($role = null) {
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    if ($role && $_SESSION['mode'] !== $role) {
        echo "<script>
            alert('You cannot access this page in {$_SESSION['mode']} mode. Please change it in your profile.');
            window.location.href = 'profile.php';
        </script>";
        exit;
    }
}
?>
