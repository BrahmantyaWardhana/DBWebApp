<?php
session_start();

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
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card mt-5">
                        <div class="card-reader">
                            <h2 class="display-6 text-center">Display Doctors Table Test</h2>
                        </div>
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td> Doctor ID </td>
                                    <td> First Name </td>
                                    <td> Last Name </td>
                                    <td> Specialization </td>
                                    <td> Status </td>
                                    <td> Email </td>
                                <tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
    </body>