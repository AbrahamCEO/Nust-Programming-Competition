<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link rel="stylesheet" href="user_styles.css">
</head>
<body>
    <div class="user-container">
        <header>
            <h1>Welcome to the NUST Programming Competition</h1>
            <span class="welcome-msg">Hello, <?php echo $_SESSION["username"]; ?></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </header>
        <main>
            <div class="content-box">
                <h2>Dashboard</h2>
                <p>Explore the latest updates, upcoming events, and resources related to the competition.</p>
            </div>
        </main>
    </div>
</body>
</html>
