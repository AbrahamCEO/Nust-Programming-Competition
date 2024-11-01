<?php 
session_start();
error_reporting(E_ALL); // Enable all error reporting
ini_set('display_errors', 1); // Display errors on the screen

require_once 'db_connection.php'; // Ensure this points to your database connection file

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    $email = $input['email'];
    $password = $input['password'];

    // Validate email and password (this should match your registration process)
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Delete the user from both tables
            $deleteStmt = $conn->prepare("DELETE FROM users WHERE email = ?");
            $deleteStmt->bind_param("s", $email);
            $deleteStmt->execute();

            if ($deleteStmt->affected_rows > 0) {
                // Destroy session to log out the user
                session_destroy();
                echo json_encode(['status' => 'success', 'message' => 'Account deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error deleting account.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Incorrect password.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Email not found.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
