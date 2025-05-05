<?php
function require_auth($role = null) {
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    $mode = $_SESSION['mode'] ?? '';

    if (strpos($_SERVER['PHP_SELF'], 'admin') !== false) {
        if ($mode !== 'admin') {
            $prev = $_SERVER['HTTP_REFERER'] ?? 'profile.php';
            echo "<script>
                alert('You are not allowed to access this page.');
                window.location.href = '$prev';
            </script>";
            exit;
        }
    } else {
        if ($mode === 'admin') {
            $prev = $_SERVER['HTTP_REFERER'] ?? 'admin-dashboard.php';
            echo "<script>
                alert('Admin is not allowed to access this page.');
                window.location.href = '$prev';
            </script>";
            exit;
        }

        if ($role && $mode !== $role) {
            echo "<script>
                alert('You cannot access this page in $mode mode. Please change it in your profile.');
                window.location.href = 'profile.php';
            </script>";
            exit;
        }
    }
}
?>
