<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_styles.css">
</head>
<body>
    <div class="admin-container">
        <header>
            <h1>Admin Dashboard</h1>
            <span class="welcome-msg">Welcome, <?php echo $_SESSION["username"]; ?></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </header>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Manage Competitions</a></li>
                <li><a href="#">Broadcast Messages</a></li>
                <li><a href="#">User Registrations</a></li>
                <li><a href="#">Sponsors</a></li>
                <li><a href="#">Reports</a></li>
            </ul>
        </nav>
        <main>
            <div class="dashboard-content">
                <h2>Dashboard Overview</h2>
                <p>This is where you can manage all aspects of the NUST Annual Programming Competition.</p>
            </div>
        </main>
    </div>
</body>
</html>
