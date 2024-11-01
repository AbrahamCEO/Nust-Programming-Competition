<?php
include "db_connection.php";
session_start();

$data = mysqli_connect($host, $user, $password, $db);
if ($data === false) {
    die("Connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statements to prevent SQL injection
    $stmt = $data->prepare("SELECT id, username, usertype FROM login WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if the user exists and fetch usertype
    if ($row) {
        $_SESSION["username"] = $row["username"];
        $_SESSION["user_id"] = $row["id"]; // Store user_id in the session

        if ($row["usertype"] == "user") {
            header("location:userhome.php");
            exit;
        } elseif ($row["usertype"] == "admin") {
            header("location:adminhome.php");
            exit;
        }
    } else {
        $error_message = "Username or password incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NUST Programming Competition</title>
    <link rel="stylesheet" href="login_styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>Login</h1>
            <?php if(isset($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form action="#" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                </div>
                <div class="input-group">
                    <input type="submit" name="Login" class="login-btn" value="Login">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
