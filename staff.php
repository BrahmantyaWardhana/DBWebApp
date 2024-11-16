<?php
session_start();

// Ensure the user is logged in and is a staff member
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    // Redirect to login if not logged in or not a staff member
    header("Location: login.php");
    exit;
}

// Staff-specific content here
echo "Welcome Staff, " . $_SESSION['username'] . "!";
?>
