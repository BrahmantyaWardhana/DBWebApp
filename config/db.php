<?php

$con = mysqli_connect('localhost', 'test', 'test', 'itmd422');

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>