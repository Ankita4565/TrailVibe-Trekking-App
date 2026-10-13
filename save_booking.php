<?php
$conn = mysqli_connect("localhost", "root", "", "trailvibe");

$fort = $_POST['fort'];
$name = $_POST['user_name'];
$mobile = $_POST['Mobile_Number'];
$village = $_POST["Village"];


mysqli_query($conn, "INSERT INTO booking(fort,user_name,Mobile_Number,Village) values('$fort','$name','$mobile','$village')");


if(mysqli_query($conn,$sql)){
    echo "<h2> Booking Successfully</h2>";
    echo "<p>Fort: <b>$fort</b></p>";
}
else{
    echo "Insert Error:" .mysqli_error($conn);
}

mysqli_close($conn);
?>