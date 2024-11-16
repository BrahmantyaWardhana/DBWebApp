<?php

// Ensure the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    // Redirect to login if not logged in or not an admin
    header("Location: index.php");
    exit;
}

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
        <p><?php
        
            // Admin-specific content here
            echo "Admin username: " . $_SESSION['username'] . " Add Admin Interface";   

        ?></p>
        <!-- Logout Button -->
        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
    </body>