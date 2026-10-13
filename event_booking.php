<?php
$fort = $_GET['fort'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trek Events Booking</title>
    <style>
       
        body {
            font-family: 'Arial', sans-serif;
            background: #e0f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        
        .box {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 350px;
            max-width: 90%;
        }

       
        h2 {
            text-align: center;
            color: #00796b;
            margin-bottom: 10px;
        }

        h1 {
            text-align: center;
            color: #004d40;
            margin-bottom: 30px;
            font-size: 24px;
        }

        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #004d40;
        }

        
        input[type="text"],
        input[type="number"],
        input[type="email"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 20px;
            border: 1px solid #b2dfdb;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
            transition: 0.3s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="email"]:focus {
            border-color: #00796b;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 121, 107, 0.5);
        }

      
        button {
            width: 100%;
            padding: 12px;
            background: #00796b;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #004d40;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2>You are booking:</h2>
        <h1><?php echo htmlspecialchars($fort); ?></h1>

        <form action="save_event_booking.php" method="post">
          
            <input type="hidden" name="fort" value="<?php echo htmlspecialchars($fort); ?>">

            <label for="user_name">Name:</label>
            <input type="text" id="user_name" name="user_name" placeholder="Enter your name" required>

            <label for="Mobile_Number">Mobile:</label>
            <input type="text" id="Mobile_Number" name="Mobile_Number" placeholder="Enter mobile number" required>

            <label for="Village">Where from:</label>
            <input type="text" id="Village" name="Village" placeholder="Enter your village" required>

            <label for="Address">Address:</label>
            <input type="text" id="Address" name="Address" placeholder="Enter your Address" required>

            <button type="submit">Confirm Booking</button>
        </form>
    </div>
</body>

</html>
