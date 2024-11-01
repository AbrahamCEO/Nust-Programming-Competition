<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("location:login.php");
    exit;
}

include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['competition_id'])) {
    // Get the competition ID
    $competition_id = mysqli_real_escape_string($conn, $_POST['competition_id']);

    // Prepare the DELETE SQL query
    $query = "DELETE FROM competitions WHERE id = '$competition_id'";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Redirect back to the admin home page after deletion
        header("location:adminhome.php");
        exit;
    } else {
        echo "Error deleting competition: " . mysqli_error($conn);
    }
}
?>
