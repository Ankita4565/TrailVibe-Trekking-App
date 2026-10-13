<?php
session_start();
include "db.php";

if (!isset($_SESSION['admin_email'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data
    $trek_name = $_POST['trek_name'];
    $trek_date = $_POST['trek_date'];
    $fort_place = $_POST['fort_place'];
    $location = $_POST['location'];
    $difficulty = $_POST['difficulty'];
    $pickup_location = $_POST['pickup_location'];
    $drop_location = $_POST['drop_location'];
    $days = $_POST['days'];
    $breakfast = $_POST['breakfast'];
    $lunch = $_POST['lunch'];
    $dinner = $_POST['dinner'];
    $price = $_POST['price'];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = time() . "_" . $_FILES['image']['name']; // add timestamp to avoid duplicates
        $tmp_name   = $_FILES['image']['tmp_name'];

        // Move file to main project folder
        if (move_uploaded_file($tmp_name, $image_name)) {
            // Save image name in DB
            $stmt = $conn->prepare("INSERT INTO weekend_treks
            (trek_name, trek_date, fort_place, location, difficulty,
            pickup_location, drop_location, days,
            breakfast, lunch, dinner, price, image)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("sssssssssssss", 
                $trek_name, $trek_date, $fort_place, $location, $difficulty,
                $pickup_location, $drop_location, $days,
                $breakfast, $lunch, $dinner, $price, $image_name
            );

            if ($stmt->execute()) {
                $_SESSION['success'] = "Trek added successfully!";
            } else {
                $_SESSION['success'] = "DB Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $_SESSION['success'] = "Failed to upload image!";
        }
    } else {
        $_SESSION['success'] = "No image selected!";
    }

    header("Location: admin_dashboard.php");
    exit;
}
?>
