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

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $id = $_POST["doctorID"];
    $fname = $_POST["firstName"];
    $lname = $_POST["lastName"];
    $specialization = $_POST["specialization"];
    $status = $_POST["status"];
    $email = $_POST["email"];
    
    do {
        if ( empty($id) || empty($fname) || empty($lname) || empty($specialization) || empty($status) || empty($email) ) {
            $errorMessage = "All fields are required";
            break;
        }
        
        // reset entries

        $id = "";
        $fname = "";
        $lname = "";
        $specialization = "";
        $status = "";
        $email = "";

        $successMessage = "New entries successfully added";

    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container my-5">
            <h2 class="display-6 text-center">Update Doctors Table Test</h2>

            <?php 
            if ( !empty($errorMessage)) {
                echo "
                <div class='alert alert-warning alert-dismissable fade show' roles='alert'>
                    <strong>$errorMessage</strong>
                    <button class='btn-close' type ='button' data-bs-dismiss='alert' aria-label='close'</button>
                </div>
                ";
            }
            ?>

            <form method="POST">
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Doctor ID</label>
                    <div class="col-sm-6">
                        <input type="test" class="form-control" name="doctorID" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">First Name</label>
                    <div class="col-sm-6">
                        <input type="test" class="form-control" name="firstName" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Last Name</label>
                    <div class="col-sm-6">
                        <input type="test" class="form-control" name="lastName" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Specialization</label>
                    <div class="col-sm-6">
                        <input type="test" class="form-control" name="specialization" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Status</label>
                    <div class="col-sm-6">
                        <input type="test" class="form-control" name="status" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Email</label>
                    <div class="col-sm-6">
                        <input type="test" class="form-control" name="email" value="">
                    </div>
                </div>

                <?php 
                if ( !empty($successMessage) ) {
                    echo "
                    <div> class ='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert' alert-success alert-dismissible fade show' role='alert'>
                                <strong>$successMessage</strong>
                                <button class='btn-close' type ='button' data-bs-dismiss='alert' aria-label='close'</button>
                            </div>
                        </div>
                    </div>
                    ";
                }
                ?> 

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