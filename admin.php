<?php
session_start();

// Ensure the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    // Redirect to login if not logged in or not an admin
    header("Location: login.php");
    exit;
}

// Admin-specific content here
echo "Welcome Admin, " . $_SESSION['username'] . "!";
?>
