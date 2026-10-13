<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name  = $_POST['first_name']  ?? '';
    $last_name   = $_POST['last_name']   ?? '';
    $email       = $_POST['email']       ?? '';
    $rawPassword = $_POST['password']    ?? '';
    $phone       = $_POST['phone']       ?? '';
    $dob         = $_POST['dob']         ?? '';
    $nationality = $_POST['nationality'] ?? '';

    if ($email === '' || $rawPassword === '') {
        die("Email and password required");
    }

    $password = password_hash($rawPassword, PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        die("Email already registered");
    }

    $stmt = $conn->prepare(
        "INSERT INTO users 
        (first_name, last_name, email, password, phone, dob, nationality, role)
        VALUES (?, ?, ?, ?, ?, ?, ?, 'user')"
    );

    $stmt->bind_param(
        "sssssss",
        $first_name,
        $last_name,
        $email,
        $password,
        $phone,
        $dob,
        $nationality
    );

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        die("Insert error: " . $stmt->error);
    }
}
?>
