<?php
session_start();
session_destroy();
header("location:login.php");
include "db_connection.php";
?>
