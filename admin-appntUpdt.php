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

require_once('config/db.php');

// Initialize variables to record input
$apptID = "";
$patientID = "";
$doctorID = "";
$apptDate = "";
$apptTime = "";
$status = "";
$reasonForVisit = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Check if 'apptID' parameter exists in the URL
    if (!isset($_GET['id'])) {
        header("Location: admin-view.php");
        exit;
    }

    $apptID = $_GET["apptID"];

    // Fetch appointment details based on the apptID
    $sql = "SELECT * FROM Appointment WHERE apptID = $apptID";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: admin-view.php");
        exit;
    }

    // Populate form fields with current data
    $patientID = $row["patientID"];
    $doctorID = $row["doctorID"];
    $apptDate = $row["apptDate"];
    $apptTime = $row["apptTime"];
    $status = $row["status"];
    $reasonForVisit = $row["reasonForVisit"];

} else {

    // Post data to update appointment
    $apptID = $_POST['apptID'];
    $patientID = $_POST['patientID'];
    $doctorID = $_POST['doctorID'];
    $apptDate = $_POST['apptDate'];
    $apptTime = $_POST['apptTime'];
    $status = $_POST['status'];
    $reasonForVisit = $_POST['reasonForVisit'];

    // Validation: Ensure no field is empty
    if (empty($patientID) || empty($doctorID) || empty($apptDate) || empty($apptTime) || empty($status) || empty($reasonForVisit)) {
        $errorMessage = 'All fields are required.';
    } else {
        // Prepare and execute SQL query to update appointment
        $sql = "UPDATE Appointment SET " .
            "patientID = '$patientID', doctorID = '$doctorID', apptDate = '$apptDate', apptTime = '$apptTime', " .
            "status = '$status', reasonForVisit = '$reasonForVisit' WHERE apptID = $apptID";

        $result = $con->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $con->error;
        } else {
            $successMessage = "Appointment updated successfully";
            header("Location: admin-view.php");
            exit;
        }
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
        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
        <div class="container my-5">
            <h2 class="display-6 text-center">Add Appointment Table</h2>

            <!-- error message -->
            <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> <?= htmlspecialchars($errorMessage) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <form method="POST">
                <input type="hidden" name="appointmentID" value="<?php echo $apptid ?>">
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Patient ID</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="patientID" value="<?php echo $patientID ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Doctor ID</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="doctorID" value="<?php echo $doctorID ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Appointment Date</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="apptDate" value="<?php echo $apptDate ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Appointment Time</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="apptTime" value="<?php echo $apptTime ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Status</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="status" value="<?php echo $status ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Reason For Visit</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="reasonForVisit" value="<?php echo $reasonForVisit ?>">
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
    </body>
</html>
