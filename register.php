<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include "db_connection.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $type_of_institution = mysqli_real_escape_string($conn, $_POST['type_of_institution'] ?? '');
    $affiliation = mysqli_real_escape_string($conn, $_POST['affiliation'] ?? '');
    $past_participation = mysqli_real_escape_string($conn, $_POST['past_participation'] ?? '');
    $preferred_language = mysqli_real_escape_string($conn, $_POST['preferred_language'] ?? '');
    $preferred_ide = mysqli_real_escape_string($conn, $_POST['preferred_ide'] ?? '');
    $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
    $surname = mysqli_real_escape_string($conn, $_POST['surname'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $password = $_POST['password'] ?? ''; // New password field
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number'] ?? '');
    $mentor_name = mysqli_real_escape_string($conn, $_POST['mentor_name'] ?? '');
    $mentor_email = mysqli_real_escape_string($conn, $_POST['mentor_email'] ?? '');
    $mentor_contact = mysqli_real_escape_string($conn, $_POST['mentor_contact'] ?? '');

    // Hash the password for security
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Basic validation for required fields
    if (!empty($type_of_institution) && !empty($affiliation) && !empty($past_participation) && 
        !empty($preferred_language) && !empty($preferred_ide) && !empty($name) && 
        !empty($surname) && !empty($email) && !empty($contact_number) && 
        !empty($mentor_name) && !empty($mentor_email) && !empty($mentor_contact) && 
        !empty($password)) {

        // Insert into registered table
        $registered_query = "INSERT INTO registered (type_of_institution, affiliation, past_participation, 
                          preferred_language, preferred_ide, name, surname, email, 
                          contact_number, mentor_name, mentor_email, mentor_contact, registration_date) 
                          VALUES ('$type_of_institution', '$affiliation', '$past_participation', 
                          '$preferred_language', '$preferred_ide', '$name', '$surname', 
                          '$email', '$contact_number', '$mentor_name', '$mentor_email', 
                          '$mentor_contact', CURDATE())";

        // Insert into login table
        $login_query = "INSERT INTO login (email, password) VALUES ('$email', '$password')";

        // Start transaction
        mysqli_begin_transaction($conn);
        try {
            // Execute the first query
            if (!mysqli_query($conn, $registered_query)) {
                throw new Exception("Error inserting into registered table: " . mysqli_error($conn));
            }
            
            // Execute the second query
            if (!mysqli_query($conn, $login_query)) {
                throw new Exception("Error inserting into login table: " . mysqli_error($conn));
            }
            
            // Commit transaction
            mysqli_commit($conn);
            echo "Registration successful!";
            header("location:home.php");
            exit();
        } catch (Exception $e) {
            // Rollback transaction in case of error
            mysqli_rollback($conn);
            echo "Registration failed: " . $e->getMessage();
        }
    } else {
        echo "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Competition</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f7f9; color: #333; display: flex; flex-direction: column; align-items: center; padding: 20px;">
    <h2 style="color: #333; text-align: center; font-size: 2em; margin-bottom: 20px;">Register for the Competition</h2>
    <form action="register.php" method="POST" style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); max-width: 600px; width: 100%;">
        <div style="margin-bottom: 15px;">
            <label for="type_of_institution" style="font-weight: bold; display: block; margin-bottom: 5px;">Type of Institution:</label>
            <select name="type_of_institution" id="type_of_institution" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;">
                <option value="">Select</option>
                <option value="Tertiary Institution">Tertiary Institution</option>
                <option value="High School">High School</option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="affiliation" style="font-weight: bold; display: block; margin-bottom: 5px;">Affiliation:</label>
            <input type="text" name="affiliation" id="affiliation" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="past_participation" style="font-weight: bold; display: block; margin-bottom: 5px;">Participation in past NUST competition:</label>
            <select name="past_participation" id="past_participation" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;">
                <option value="">Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="preferred_language" style="font-weight: bold; display: block; margin-bottom: 5px;">Most Preferred Programming Language:</label>
            <input type="text" name="preferred_language" id="preferred_language" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="preferred_ide" style="font-weight: bold; display: block; margin-bottom: 5px;">Preferred IDE / Text Editor:</label>
            <input type="text" name="preferred_ide" id="preferred_ide" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="name" style="font-weight: bold; display: block; margin-bottom: 5px;">Name:</label>
            <input type="text" name="name" id="name" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="surname" style="font-weight: bold; display: block; margin-bottom: 5px;">Surname:</label>
            <input type="text" name="surname" id="surname" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="email" style="font-weight: bold; display: block; margin-bottom: 5px;">Email:</label>
            <input type="email" name="email" id="email" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password" style="font-weight: bold; display: block; margin-bottom: 5px;">Password:</label>
            <input type="password" name="password" id="password" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="contact_number" style="font-weight: bold; display: block; margin-bottom: 5px;">Contact Number:</label>
            <input type="tel" name="contact_number" id="contact_number" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="mentor_name" style="font-weight: bold; display: block; margin-bottom: 5px;">Mentor Name:</label>
            <input type="text" name="mentor_name" id="mentor_name" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="mentor_email" style="font-weight: bold; display: block; margin-bottom: 5px;">Mentor Email:</label>
            <input type="email" name="mentor_email" id="mentor_email" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="mentor_contact" style="font-weight: bold; display: block; margin-bottom: 5px;">Mentor Contact:</label>
            <input type="tel" name="mentor_contact" id="mentor_contact" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;">
        </div>

        <button type="submit" style="width: 100%; padding: 10px; border-radius: 4px; border: none; background-color: #007bff; color: white; font-size: 16px;">Register</button>
    </form>
</body>
</html>
