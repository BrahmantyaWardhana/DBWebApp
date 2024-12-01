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

// initializae variables to record input
$paymentID = "";
$apptID = "";
$amount = "";
$paymentDate = "";
$paymentMethod = "";
$status = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    if ( !isset($_GET['id']) ) {
        header("location: /admin-view.php");
        exit;
    }

    $paymentID = $_GET["id"];

    // Read row based on id
    $sql = "SELECT * FROM Payments WHERE PaymentID=$paymentID";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    if ( !$row ) {
        header("location: admin-view.php");
        exit;
    }

    $apptID = $row["apptID"];
    $amount = $row["amount"];
    $paymentDate = $row["paymentDate"];
    $paymentMethod = $row["paymentMethod"];
    $status = $row["status"];

} else {

    $paymentID = $_POST['paymentID'];
    $apptID = $_POST['apptID'];
    $amount = $_POST['amount'];
    $paymentDate = $_POST['paymentDate'];
    $paymentMethod = $_POST['paymentMethod'];
    $status = $_POST['status'];

    if (empty($amount) || empty($paymentDate) || empty($paymentMethod) || empty($paymentMethod) || empty($status)) {
        $errorMessage = 'All fields are required.';
    } else {
        $sql = "UPDATE Payments SET " . 
        "apptID = '$apptID', amount = '$amount', paymentDate = '$paymentDate', paymentMethod = '$paymentMethod', status = '$status'" .
        "WHERE paymentID = $paymentID";

        $result = $con->query($sql);

        if (!$result) {
            $errorMessage = "invalid query: " . $con->error;
        }
        $successMessage = "Selected entry updated successfully";
        header("location: admin-view.php");
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
            <h2 class="display-6 text-center">Add Payments Table</h2>

            <!-- error message -->
            <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> <?= htmlspecialchars($errorMessage) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <form method="POST">
                <input type="hidden" name="paymentID" value="<?php echo $paymentID ?>">
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Appointment ID</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="apptID" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Amount</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="amount" value="<?php echo $amount ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Payment Date</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="paymentDate" value="<?php echo $paymentDate ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Payment Method</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="paymentMethod" value="<?php echo $paymentMethod ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-from-label">Status</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="status" value="<?php echo $status ?>">
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