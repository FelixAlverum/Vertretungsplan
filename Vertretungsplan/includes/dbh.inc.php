<?php
// dbh.inc.php = Database Handler Include Part = runs in background

// Variables for connection
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "vertretungsplan"; // Name of the Database

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
?>
