<?php
include "db_connection.php"; // Database connection


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id, title, message, created_at FROM broadcast ORDER BY created_at DESC");
    $broadcasts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($broadcasts);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
