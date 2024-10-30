<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "hackathon";

// Create a connection
$conn = mysqli_connect($host, $user, $password, $db);

// Check connection
if ($conn === false) {
    die("Connection error: " . mysqli_connect_error());
}
?>
