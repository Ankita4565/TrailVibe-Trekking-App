<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: login.php");
    exit;
}

include "db.php";


if (isset($_SESSION['success'])) {
    echo "<script>alert('{$_SESSION['success']}');</script>";
    unset($_SESSION['success']);
}


$data = mysqli_query($conn, "SELECT * FROM weekend_treks ORDER BY trek_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; padding:20px; }
        input, select { padding:8px; width:250px; margin:5px 0; }
        button { padding:10px 20px; background:#00796b; color:#fff; border:none; cursor:pointer; }
        table { width:100%; border-collapse:collapse; margin-top:30px; background:#fff; }
        th, td { border:1px solid #ccc; padding:10px; text-align:center; }
        th { background:#00796b; color:white; }
        img { border-radius:6px; }
    </style>
</head>

<body>

<h2>Welcome Admin</h2>
<a href="logout.php">Logout</a>

<hr>

<h3>Add Weekend Trek</h3>

<form method="post" action="admin_add_tre.php" enctype="multipart/form-data">

    <input type="text" name="trek_name" placeholder="Trek Name" required><br>

    <input type="date" name="trek_date" required><br>

    <input type="text" name="fort_place" placeholder="Fort Place" required><br>

    <input type="text" name="location" placeholder="Village / Location" required><br>

    <select name="difficulty" required>
        <option value="">Select Difficulty</option>
        <option>Easy</option>
        <option>Medium</option>
        <option>Hard</option>
    </select><br>

    <input type="text" name="pickup_location" placeholder="Pickup Location" required><br>

    <input type="text" name="drop_location" placeholder="Drop Location" required><br>

    <input type="number" name="days" placeholder="Number of Days" required><br>

    <b>Meals Included</b><br><br>

    Breakfast:
    <input type="radio" name="breakfast" value="Yes" required> Yes
    <input type="radio" name="breakfast" value="No"> No<br><br>

    Lunch:
    <input type="radio" name="lunch" value="Yes" required> Yes
    <input type="radio" name="lunch" value="No"> No<br><br>

    Dinner:
    <input type="radio" name="dinner" value="Yes" required> Yes
    <input type="radio" name="dinner" value="No"> No<br><br>

    <input type="number" name="price" placeholder="Price" required><br>

    <input type="file" name="image" accept="image/*" required><br><br>

    <button type="submit">Add Trek</button>
</form>

<hr>

<h3>All Weekend Treks</h3>

<table>
<tr>
    <th>Image</th>
    <th>Name</th>
    <th>Date</th>
    <th>Location</th>
    <th>Difficulty</th>
    <th>Days</th>
    <th>Meals</th>
    <th>Price</th>
    <th>Action</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($data)) { ?>
<tr>
    <td>
       <img src="<?= $row['image'] ?>" width="80" alt="<?= $row['trek_name'] ?>">

    </td>
    <td><?= $row['trek_name'] ?></td>
    <td><?= $row['trek_date'] ?></td>
    <td><?= $row['location'] ?></td>
    <td><?= $row['difficulty'] ?></td>
    <td><?= $row['days'] ?></td>
    <td>
        B: <?= $row['breakfast'] ?><br>
        L: <?= $row['lunch'] ?><br>
        D: <?= $row['dinner'] ?>
    </td>
    <td>₹<?= $row['price'] ?></td>
    <td>
        <a href="delete_trek.php?id=<?= $row['id'] ?>">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
