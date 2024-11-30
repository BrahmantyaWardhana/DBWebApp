<?php
// enable error message
ini_set('display_errors', 1);
error_reporting(E_ALL);


session_start();

// Ensure the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    // Redirect to login if not logged in or not an admin
    header("Location: index.php");
    exit;
}

include_once('config/db.php');

// initializae variables to record input
$fname = "";
$lname = "";
$phone = "";
$email = "";
$address = "";
$gender = "";
$birthdate = "";

$errorMessage="";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];

    if (empty($fname) || empty($lname) || empty($phone) || empty($email) || empty($address) || empty($gender) || empty($birthdate)) {
        $errorMessage = 'All fields are required.';
    } else {
        // Prepare and execute the SQL query to insert data into the database
        $sql = "INSERT INTO Patients (firstName, lastName, phone, email, address, gender, birthdate) " .
                "VALUES ('$fname', '$lname', '$phone', '$email', '$address', '$gender', '$birthdate')";

        $result = $con->query($sql);

        if (! $result) {
            $errorMessage = "Invalid query: " . $con->error;
        }

        // Reset the form variables
        $fname=$lname=$phone=$email=$address=$gender=$birthdate= '';
        header("location: admin-view.php");
        exit;
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
            <h2 class="display-6 text-center">Add Patients</h2>

            <!-- error message -->
            <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> <?= htmlspecialchars($errorMessage) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <form method="POST">
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
                    <label class="col-sm-3 col-from-label">Phone</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="phone" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Email</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="email" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Address</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="address" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Gender</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="gender" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Birth Date</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="birthdate" value="">
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