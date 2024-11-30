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
$schedule = mysqli_query($con,$query);

$query = "SELECT * FROM Clinic";
$clinic = mysqli_query($con,$query);

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
    <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
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
                                        <th> Clinic ID </th>
                                        <th> Action </th>
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
                                        <td><?php echo $row['clinicID']; ?></td>
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
                                        <th> Action</th>
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
                    <div class="card mt-5">
                        <!-- Start of Appointment view -->
                        <div class="card-reader">
                            <h2 class="display-6 text-center">Appointments Table</h2>
                            <a class="btn btn-primary" href="admin-appntAdd.php" role="button">New Entry</a>
                            <br>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Appointment ID </th>
                                        <th> Patient ID </th>
                                        <th> Doctor ID </th>
                                        <th> Appointment Date </th>
                                        <th> Appointment Time </th>
                                        <th> Status </th>
                                        <th> Reason for Visit </th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($appointment)) { ?>
                                    <tr>
                                        <td><?php echo $row['apptID']; ?></td>
                                        <td><?php echo $row['patientID']; ?></td>
                                        <td><?php echo $row['doctorID']; ?></td>
                                        <td><?php echo $row['apptDate']; ?></td>
                                        <td><?php echo $row['apptTime']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td><?php echo $row['reasonForVisit']; ?></td>
                                        <td> 
                                            <a class="btn btn-primary btn-sm" href="admin-appntUpdt.php?id=<?php echo $row['apptID']; ?>">Edit</a>
                                            <a class="btn btn-danger btn-sm" href="admin-appntDel.php?id=<?php echo $row['apptID']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End of Appointment view -->
                    </div>
                    <div class="card mt-5">
                        <!-- Start of Payment view -->
                        <div class="card-reader">
                            <h2 class="display-6 text-center">Payments Table</h2>
                            <a class="btn btn-primary" href="admin-pmntAdd.php" role="button">New Entry</a>
                            <br>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Payment ID </th>
                                        <th> Appointment ID </th>
                                        <th> Payment Amount </th>
                                        <th> Payment Date </th>
                                        <th> Payment Method </th>
                                        <th> Status </th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($payment)) { ?>
                                    <tr>
                                        <td><?php echo $row['paymentID']; ?></td>
                                        <td><?php echo $row['apptID']; ?></td>
                                        <td><?php echo $row['amount']; ?></td>
                                        <td><?php echo $row['paymentDate']; ?></td>
                                        <td><?php echo $row['paymentMethod']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td> 
                                            <a class="btn btn-primary btn-sm" href="admin-pmntUpdt.php?id=<?php echo $row['paymentID']; ?>">Edit</a>
                                            <a class="btn btn-danger btn-sm" href="admin-pmntDel.php?id=<?php echo $row['paymentID']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End of Payment view -->
                    </div>
                    <div class="card mt-5">
                        <!-- Start of Schedule view -->
                        <div class="card-reader">
                            <h2 class="display-6 text-center">Schedule Table</h2>
                            <a class="btn btn-primary" href="admin-scheduleAdd.php" role="button">New Entry</a>
                            <br>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Schedule ID </th>
                                        <th> Doctor ID </th>
                                        <th> Day of the Week </th>
                                        <th> Start Time </th>
                                        <th> End Time </th>
                                        <th> Clinic </th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($schedule)) { ?>
                                    <tr>
                                        <td><?php echo $row['scheduleID']; ?></td>
                                        <td><?php echo $row['doctorID']; ?></td>
                                        <td><?php echo $row['dayOfTheWeek']; ?></td>
                                        <td><?php echo $row['startTime']; ?></td>
                                        <td><?php echo $row['endTime']; ?></td>
                                        <td><?php echo $row['clinicName']; ?></td>
                                        <td> 
                                            <a class="btn btn-primary btn-sm" href="admin-scheduleUpdt.php?id=<?php echo $row['scheduleID']; ?>">Edit</a>
                                            <a class="btn btn-danger btn-sm" href="admin-scheduleDel.php?id=<?php echo $row['scheduleID']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End of Schedule view -->
                    </div>
                    <div class="card mt-5">
                        <!-- Start of Clinic view -->
                        <div class="card-reader">
                            <h2 class="display-6 text-center">Schedule Table</h2>
                            <a class="btn btn-primary" href="admin-clinicAdd.php" role="button">New Entry</a>
                            <br>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Clinic ID </th>
                                        <th> Clinic Name </th>
                                        <th> Address </th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($schedule)) { ?>
                                    <tr>
                                        <td><?php echo $row['clinicID']; ?></td>
                                        <td><?php echo $row['clinicName']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td> 
                                            <a class="btn btn-primary btn-sm" href="admin-clinicUpdt.php?id=<?php echo $row['clinicID']; ?>">Edit</a>
                                            <a class="btn btn-danger btn-sm" href="admin-clinicDel.php?id=<?php echo $row['clinicID']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End of Clinic view -->
                    </div>
                </div>
            </div>
        </div>
    </body>