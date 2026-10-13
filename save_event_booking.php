<?php
$conn = mysqli_connect("localhost", "root", "", "trailvibe");

$fort = $_POST['fort'];
$name = $_POST['user_name'];
$mobile = $_POST['Mobile_Number'];
$village = $_POST['Village'];
$address = $_POST['Address'];



mysqli_query($conn, "INSERT INTO booking(fort,user_name,Mobile_Number,Village,Address) values('$fort','$name','$mobile','$village','$address')");


echo "<h2>Booking Successfully</h2>";


mysqli_close($conn);
