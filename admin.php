<?php
$conn = mysqli_connect("localhost", "root", "", "trekking");
$result = mysqli_query($conn, "SELECT * FROM bookings");
?>

<h2>All Bookings</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Fort Name</th>
        <th>User Name</th>
        <th>Mobile</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['fort']; ?></td>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['mobile']; ?></td>
        </tr>
    <?php } ?>
</table>