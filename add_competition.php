<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("location:login.php");
    exit;
}

include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Handle file upload
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $logo = $_FILES['logo'];
        $logo_path = 'uploads/' . basename($logo['name']); // Set the upload directory

        // Move the uploaded file to the designated folder
        if (move_uploaded_file($logo['tmp_name'], $logo_path)) {
            // Prepare SQL query
            $query = "INSERT INTO competitions (title, description, start_date, end_date, logo_path) 
                      VALUES ('$title', '$description', '$start_date', '$end_date', '$logo_path')";

            // Execute query
            if (mysqli_query($conn, $query)) {
                header("location:adminhome.php");
                exit;
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to upload logo.";
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
