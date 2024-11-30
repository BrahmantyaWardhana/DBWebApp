<?php
session_start();

// Ensure the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    // Redirect to login if not logged in or not an admin
    header("Location: index.php");
    exit;
}

require_once('config/db.php');

// debugging check db connection
//echo "Connected successfully";
$query = "SELECT * FROM Doctor";
$doctor = mysqli_query($con,$query);

$query = "SELECT * FROM Patients";
$patient = mysqli_query($con,$query);

$query = "SELECT * FROM Appointment";
$appointment = mysqli_query($con,$query);

$query = "SELECT * FROM Payments";
$payment = mysqli_query($con,$query);

$query = "SELECT * FROM Schedule";
$patient = mysqli_query($con,$query);

$query = "SELECT * FROM Clinic";
$patient = mysqli_query($con,$query);

// debugging check query
#if (!$doctor) {
#    die("Query failed: " . mysqli_error($con));
#}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page</title>
        <link rel="stylesheet" href="css/table-view.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card mt-5">
                        <!-- Start of Doctor view -->
                        <div class="card-reader">
                            <h2 class="display-6 text-center">Doctors Table</h2>
                            <a class="btn btn-primary" href="admin-doctorAdd.php" role="button">New Entry</a>
                            <br>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Doctor ID </th>
                                        <th> First Name </th>
                                        <th> Last Name </th>
                                        <th> Specialization </th>
                                        <th> Status </th>
                                        <th> Email </th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($doctor)) { ?>
                                    <tr>
                                        <td><?php echo $row['doctorID']; ?></td>
                                        <td><?php echo $row['firstName']; ?></td>
                                        <td><?php echo $row['lastName']; ?></td>
                                        <td><?php echo $row['specialization']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td> 
                                            <a class="btn btn-primary btn-sm" href="admin-doctorUpdt.php?id=<?php echo $row['doctorID']; ?>">Edit</a>
                                            <a class="btn btn-danger btn-sm" href="admin-doctorDel.php?id=<?php echo $row['doctorID']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End of Doctor view -->
                    </div>
                    <div class="card mt-5">
                        <!-- Start of Patient view -->
                        <div class="card-reader">
                            <h2 class="display-6 text-center">Patients Table</h2>
                            <a class="btn btn-primary" href="admin-patientAdd.php" role="button">New Entry</a>
                            <br>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Patient ID </th>
                                        <th> First Name </th>
                                        <th> Last Name </th>
                                        <th> Phone </th>
                                        <th> Email </th>
                                        <th> Address </th>
                                        <th> Gender </th>
                                        <th> Birth Date </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($patient)) { ?>
                                    <tr>
                                        <td><?php echo $row['patientID']; ?></td>
                                        <td><?php echo $row['firstName']; ?></td>
                                        <td><?php echo $row['lastName']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['gender']; ?></td>
                                        <td><?php echo $row['birthdate']; ?></td>
                                        <td> 
                                            <a class="btn btn-primary btn-sm" href="admin-patientUpdt.php?id=<?php echo $row['patientID']; ?>">Edit</a>
                                            <a class="btn btn-danger btn-sm" href="admin-patientDel.php?id=<?php echo $row['patientID']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End of patient view -->
                    </div>
                </div>
            </div>
        </div>
        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
    </body>