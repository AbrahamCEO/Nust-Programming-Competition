<?php
session_start();
if(!isset($_SESSION["username"])) //Only logged in users can access admin dashboard
{
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h1>This is admin dashboard</h1> <?php echo $_SESSION["username"]; ?>

    <a href="logout.php">Logout</a>
</body>
</html>