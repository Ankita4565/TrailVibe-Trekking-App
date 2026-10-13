<?php
session_start();
if(!isset($_SESSION['admin_email'])){
    header("Location: login.php");
    exit;
}
include "db.php";

$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM weekend_treks WHERE id=$id");

header("Location: admin_dashboard.php");
exit;
?>
