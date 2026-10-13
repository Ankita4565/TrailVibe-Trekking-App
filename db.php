<?php
$servername = "127.0.0.1";
$username   = "root";
$password   = "";
$dbname     = "trailvibe";
$port       = 3307;   // ⭐ MUST MATCH phpMyAdmin

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
