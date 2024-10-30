<?php
include "db_connection.php";
session_start();

$data = mysqli_connect($host, $user, $password, $db);
if ($data === false) {
    die("connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM login WHERE username = '" . $username . "' AND password = '" . $password . "'";
    $result = mysqli_query($data, $sql);
    $row = mysqli_fetch_array($result);

    if ($row["usertype"] == "user") {
        $_SESSION["username"] = $username;
        header("location:userhome.php");
    } elseif ($row["usertype"] == "admin") {
        $_SESSION["username"] = $username;
        header("location:adminhome.php");
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
