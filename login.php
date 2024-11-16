<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection 
    ############ Change these to appropriate DB credentials ############
    $mysqli = new mysqli('localhost', 'test', 'test', 'itmd422'); //('host', 'user', 'password', 'database name')

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Query to check if the user exists
    $stmt = $mysqli->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $db_username, $db_password, $role);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();

        // Compare the plain-text password
        if ($password === $db_password) {
            // Password is correct, start session
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $db_username;
            $_SESSION['role'] = $role;  // Store the role in session

            // Redirect based on the role
            if ($role == 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: staff.php");
            }
            exit;
        } else {
            // Password incorrect
            echo "Invalid password.";
        }
    } else {
        // User doesn't exist
        echo "User not found.";
    }

    $stmt->close();
    $mysqli->close();
}
?>
