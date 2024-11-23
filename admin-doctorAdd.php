<?php
session_start();

// Ensure the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    // Redirect to login if not logged in or not an admin
    header("Location: index.php");
    exit;
}

// initializae variables to record input
$id = "";
$fname = "";
$lname = "";
$specialization = "";
$status = "";
$email = "";

$errorMessage="";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['doctorID'] ?? '';
    $fname = $_POST['firstName'] ?? '';
    $lname = $_POST['lastName'] ?? '';
    $specialization = $_POST['specialization'] ?? '';
    $status = $_POST['status'] ?? '';
    $email = $_POST['email'] ?? '';

    if (empty($id) || empty($fname) || empty($lname) || empty($specialization) || empty($status) || empty($email)) {
        $errorMessage = 'All fields are required.';
    } else {
        $successMessage = 'New entries successfully added.';
        // Reset the form variables
        $id = $fname = $lname = $specialization = $status = $email = '';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
        <div class="container my-5">
            <h2 class="display-6 text-center">Update Doctors Table Test</h2>

            <!-- error message -->
            <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> <?= htmlspecialchars($errorMessage) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <form method="POST">
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Doctor ID</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="doctorID" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">First Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="firstName" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Last Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="lastName" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Specialization</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="specialization" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Status</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="status" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Email</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="email" value="">
                    </div>
                </div>

                <!-- success message -->
                <?php if (!empty($successMessage)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> <?= htmlspecialchars($successMessage) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <!-- submit button -->
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="admin-view.php" role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
    </body>