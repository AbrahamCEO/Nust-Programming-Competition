<?php
header('Content-Type: application/json');
session_start();
include "db_connection.php"; // Ensure you have a valid connection

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['email'], $data['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing email or password']);
    exit;
}

$email = $data['email'];
$password = $data['password'];

// Check if user exists and password is correct
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        // Delete the account
        $delete_sql = "DELETE FROM users WHERE email = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("s", $email);
        $delete_stmt->execute();

        if ($delete_stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success']);
            session_destroy(); // End the session
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete account.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Incorrect password.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found.']);
}

$conn->close();
?>
