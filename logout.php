<?php

// Whenever the variable 'logout' is called this destroy session will be called
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_destroy();
    header("location: index.php")
    exit;
}
?>
