<?php
session_start();

// Ensure the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    // Redirect to login if not logged in or not an admin
    header("Location: login.php");
    exit;
}

// Identify login username credentials
echo "Admin username: " . $_SESSION['username'] . " Add Admin Interface";
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