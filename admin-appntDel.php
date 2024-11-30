<?php
require_once("config/db.php");

if ( isset( $_GET["id"]) ) {
    $id = (int) $_GET["id"];

    $sql = "DELETE FROM Appointment WHERE apptID = $id";
    $con->query( $sql );
}

header("location: admin-view.php");
exit;