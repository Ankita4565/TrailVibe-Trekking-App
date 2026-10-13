<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email !== '' && $password !== '') {

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row['password'])) {

                $_SESSION['email'] = $row['email'];
                $_SESSION['role']  = strtolower(trim($row['role']));

                if ($_SESSION['role'] == 'admin') {

                    $_SESSION['admin_email'] = $row['email'];

                    header("Location: admin_dashboard.php");
                    exit;

                }
                else {

                    header("Location: HY.php");
                    exit;

                }

            } else {

                $error = "Incorrect password";

            }

        } else {

            $error = "Email not found";

        }

    } else {

        $error = "Please enter email and password";

    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login Page</title>


<style>

body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 50px;
}


.logo {
    text-align: center;
    margin-bottom: 20px;
}


.logo img {
    width: 200px;
}


.login-box {

    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    width:350px;
    position:relative;

}


h2 {

    margin-bottom:20px;
    font-size:20px;

}


label {

    display:block;
    margin-top:15px;
    font-weight:bold;

}


input[type="email"],
input[type="password"] {

    width:100%;
    padding:10px;
    margin-top:5px;
    border:1px solid orange;
    border-radius:6px;
    font-size:14px;
    box-sizing:border-box;

}


.forgot {

    display:block;
    margin-top:5px;
    font-size:0.9em;
    color:#0073e6;

}


.remember {

    display:flex;
    align-items:center;
    gap:5px;
    margin-top:15px;

}


button {

    width:100%;
    margin-top:20px;
    background:#4CAF50;
    color:white;
    padding:12px;
    border:none;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;

}


button:hover {

    background:#45a049;

}


.register {

    text-align:center;
    margin-top:15px;
    font-size:0.9em;

}


.register a {

    color:#0073e6;
    text-decoration:none;

}


.error {

    color:red;
    text-align:center;
    margin-bottom:10px;

}


</style>

</head>


<body>


<div class="logo">

<img src="Trailvibe.jpg" alt="Logo">

<p style="font-size:12px;color:gray;">
TREKS THAT TRANSFORM LIVES
</p>

</div>



<div class="login-box">


<h2>Already a member? Sign In</h2>


<?php

if(isset($error)){

    echo "<p class='error'>$error</p>";

}

?>


<form method="post" action="login.php">


<label>Email</label>

<input type="email" 
name="email" 
placeholder="Enter your email" 
required>



<label>Password</label>

<input type="password" 
name="password" 
placeholder="Enter your password" 
required>



<a href="#" class="forgot">
Forgot Password?
</a>



<div class="remember">

<input type="checkbox" id="remember">

<label for="remember" style="font-weight:normal;">
Remember me
</label>

</div>



<button type="submit">
Sign In
</button>


</form>



<div class="register">

New to TrailVibe? 

<a href="Registrationpage.html">
Register Here
</a>

</div>


</div>



</body>

</html>