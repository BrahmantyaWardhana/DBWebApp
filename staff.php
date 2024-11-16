<?php
session_start();

// Ensure the user is logged in and is a staff member
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    // Redirect to login if not logged in or not a staff member
    header("Location: login.php");
    exit;
}

// Staff-specific content here
echo "Staff username: " . $_SESSION['username'] . " Add Staff Interface";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    </body>
    <script>
        window.addEventListener('beforeunload', function (e) {
            // Send an AJAX request to destroy the session when the tab is closed
            fetch('logout.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'destroy=true'
            });
        });
    </script>
