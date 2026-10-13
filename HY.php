<?php
session_start();
include_once __DIR__ . "/db.php";
$data = mysqli_query($conn, "
    SELECT id, trek_name, trek_date, location, price, image
    FROM weekend_treks
    ORDER BY trek_date ASC
");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrailVibe</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .container {
            background-color: #f8f9fa;
            width: 100%;
            padding: 10px;
        }

        .logo img {
            width: 90px;
            height: 90px;
        }

        .Innercontainer {
            display: flex;
            align-items: center;
        }

        .letter {
            display: flex;
            gap: 20px;
            font-weight: bold;
        }

        .menu-item {
            position: relative;
            padding: 5px 10px;
            cursor: pointer;
        }

        .dropdown-content {
            display: none; 
            position: absolute;
            top: 1  00%;
            left: 0;
            background-color: white;
            border: 1px solid #ccc;
            min-width: 150px;
            z-index: 10;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .dropdown-content div {
            padding: 8px 12px;
        }

        .dropdown-content div:hover {
            background-color: #f2f2f2;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .buttons {
            margin-left: auto;
            display: flex;
            gap: 25px;
        }

        .buttons button {
            padding: 8px 16px;
            border: none;
            background-color: orange;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .banner {

            overflow: hidden;
            margin-top: 10px;
            width: 100vw;
            height: 100vh;
            object-fit: fill;
            position: relative
        }

        .banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
            clip-path: inset(0 8% 3% 0);
            margin: 0;
            margin-left: 55px;
        }

        .head {
            color: black;
            font-size: 25px;
            text-align: center;
            margin-top: 10px;
        }

        .head h2 {
            margin: 0;
            padding-top: 5px;
        }

        .br {
            border: 1px solid orange;
            width: 2000px;
            border-radius: 24%;
            margin: auto;
            margin-top: 30px;
        }



        .imgcontainer {
            width: 100%;
            background-color: white;
            display: flex;
            margin-left: 30px;
            margin-right: 50px;

        }

        .paradiv {
            width: 30%;
            padding: 20px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 5px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            text-align: left;
        }

        .heading {
            font-size: 30px;
            font-weight: normal;
        }

        .p {
            font-weight: normal;
            font-size: 16px;
            line-height: 1.5;
            font-family: Arial, sans-serif;
        }

        .info {
            font-size: 20px;
            font-family: Arial, sans-serif;
            margin-left: 30px;
        }

        .trail {
            margin-left: 20px;
            font-size: 50px;
            margin-bottom: 10px;
            ;
        }

        .outer {
            width: 100%;
            background-color: white;
            display: flex;
            gap: 0px;
            padding: 30px;
        }

        .inner {
            width: 23%;
            margin: auto;
            height: 3 00px;
            gap: 20px;
            border: 2px solid white;
            margin-left: 10px;
            margin-right: 10px;
            margin-top: 20px;

        }


        .imgclass {
            width: 100%;
            height: 100%;
            border: 2px solid black;
            border-radius: 30px;
        }

        .booking {
            display: block;
            margin: 12px auto 0;
            padding: 8px 22px;
            background: black;
            color: orange;
            border: none;
            border-radius: 5px;
            cursor: pointer;

        }


        .outerimg {
            width: 100%;
            background-color: white;
            display: flex;
            gap: 10px;

        }

        .innerimg {
            width: 23%;
            margin: auto;
            height: 3 00px;
            border: 2px solid white;
            margin-left: 20px;
            margin-right: 20px;
        }


        .imgclass1 {
            width: 100%;
            height: 100%;
            border: 2px solid black;
            border-radius: 30px;
            margin-left: 350px;
        }

        .wrapper{
          
            
        }

        .break,.break1{
            width:100px;
        
            
        }
        .week{
            font-size:24px;
            font-weight:bold;
            text-align: center;
            text-decoration: underline;
        }

        .anotherloop{ 
            margin-top:20px;
            padding: 20px;
            background-color: #bab4b4;
     }

        .btn{
            text-align:center;
            margin-bottom:20px;
        }
        .btn input{
            padding:10px;
            width:300px;
        }

        .adventure{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:20px;
        }

        .card{
            background:#fff;
            border-radius:10px;
            box-shadow:0 5px 10px rgba(0,0,0,0.15);
            overflow:hidden;
        }

        .card img{
            width:100%;
            height:180px;
            object-fit:cover;
        }

        .card-content{
            padding:15px;
        }

        .title{
            font-size:18px;
            font-weight:bold;
        }

        .location,.date,.price{
            margin-top:5px;
            color:#555;
        }

        .price{
            font-weight:bold;
            color:#000;
        }

        .link{
            display:block;
            margin-top:10px;
            padding:8px;
            background:#00796b;
            color:white;
            text-align:center;
            text-decoration:none;
            border-radius:5px;
        }

        .link:hover{
            background:#005f56;
        }

        .card-content {
            padding: 10px;
        }

        .title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .location {
            color: gray;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .date {
            color: gray;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .price {
            color: green;
            font-weight: bold;
        }
        .link {
            background: none;       
            color:black;         
            border: none;          
            cursor: pointer;        
            font-weight: bold;      
            text-decoration: none;  
            padding: 0;             
            transition: all 0.3s ease;
        }

        .link:hover {
            text-decoration: underline; 
            color:white;             
        }


        .trekk {
            background-color: #ccc;
            padding: 40px 20px;
            text-align: center;
        }

        .trekk-title {
            font-size: 40px;
            font-weight: 800;
            margin-bottom: 30px;
        }

        .trail1 {
            display: flex;
            justify-content: center;
            gap: 50px;

        }

        .mini {
            width: 200px;
            height: 90px;
            overflow: hidden;
            border-radius: 20px;
            border: 2px solid #333;
        }


        .miniimg {
            width: 100%;
            height: 100%;
            object-fit: inherit;
            display: block;
        }

        .brt {
            border: 3px solid orange;
            width: 400px;
            border-radius: 90%;

            margin-top: 30px;

        }

        .break {
            border: 1px solid orange;
            width: 2000px;
            border-radius: 24%;
            margin: auto;
            margin-top: 30px;
        }

        .cat {
            margin-left: 20px;
            font-size: 50px;
            margin-bottom: 10px;
            display: flex;
        }

        .outercat {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: nowrap;
            overflow-x: auto;
            gap: 10px;  
            padding: 20px;
            background-color: #f5f5f5;
        }

        .innercat {
            flex: 0 0 auto;
            width: 220px;
            height: 150px;
            aspect-ratio: 220 / 150;
            overflow: hidden;
            object-fit: inherit;
            flex-shrink: 0;
            display: flex;
        }

        .imgcat {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .benefit {
            background-color: lightcyan;
            font-size: 20px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            margin-left: 30px;
            margin-right: 20px;

        }

        .para {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

       

       .whatsapp-btn {
            position: fixed;      
            bottom: 20px;         
            right: 20px;         
            display: inline-block;
            background-color: #25D366; 
            color: white;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            z-index: 1000;        
        }

        .whatsapp-btn:hover {
            background-color: #1ebe5d;
        }



        .heading1 {
            color: black;
            margin-left: 560px;
            display: flex;
            margin-top: 50px;
            margin: center;
            font-size: 40px;

        }

        .hd {
            color: crimson;
        }

        .br1 {
            border: 1px solid black;
            width: 200px;
            border-radius: 2px;
            margin: auto;
            margin-top: 10px;
            margin-left: 605px;
        }

        .manybtn {
            margin: auto;
        }

        .button1 {
            bottom: 20px;
            right: 20px;
            background-color: white;
            color: black;
            padding: 12px 20px;
            border: 2px solid balck;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            font-family: sans-serif;
            cursor: pointer;
            margin-left: 50px;
            margin-top: 30px;
            margin: center;
        }

        .image1 {
            position: relative;
            display: inline-block;
        }

        .lastinfo {
            position: absolute;
            top: 70%;
            left: 30%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .bgnimg {
            display: block;
            margin: auto;
            width: 300px;
        }

        .brook {
            width: 300px;
            border-top: 2px solid white;
            margin: 5px auto 0;
        }

        .intern {
            display: flex;
            gap: 60px;
        }

        .intern1 {
            color: white;
        }

        .intern2 {
            color: white;
        }

        .intern3 {
            color: white;
        }

        .int {
            display: flex;
            gap: 50px;
        }

        .int1 {
            color: white;
        }
    </style>
</head>

<body style="margin: 0;padding:0; overflow-x:hidden; padding:0;">


    <div class="container">
        <div class="Innercontainer">
            <div class="logo">
                <img src="Trailvibe.jpg" alt="TrailVibe Logo">
            </div>

            <div class="letter">
            <div class="menu-item">Home</div>

            <div class="menu-item dropdown">
                Event Category >
                <div class="dropdown-content">
                    <div>Adventure</div>
                    <div>Cultural</div>
                    <div>Educational</div>
                </div>
            </div>

            <div class="menu-item dropdown">
                Upcoming Treks >
                <div class="dropdown-content">
                    <div>Fort Treks</div>
                    <div>Hill Treks</div>
                    <div>Weekend Treks</div>
                </div>
            </div>

            <div class="menu-item dropdown">
                Special Treks >
                <div class="dropdown-content">
                    <div>Monsoon Treks</div>
                    <div>Night Treks</div>
                </div>
            </div>

            <div class="menu-item">Fort Study Tour ></div>
        </div>

            <div class="buttons">
                <button>Contact us</button>
                <a href="login.php">
                    <button>Login</button>
                </a>

                <a href="Registrationpage.html">
                    <button>Registration</button>
                </a>

                <a href="aboutus.html">
                    <button>About us</button>
                </a>
            </div>
        </div>

        <div class="banner">
            <img src="trekfort.png" alt="Trek with us">
        </div>

        <div class="head">
            <h2>How our treks transforms lives</h2>
        </div>

        <div class="br">
        </div>

        <div class="imgcontainer">

            <div class="paradiv">
                <div class="heading"><b>Connect to yourself</b></div>
                <p class="p">Each experience on our treks is crafted to help you connect deeply with yourself. Trekkers
                    return
                    with renewed
                    perspectives, increased confidence, and heightened self-awareness. Many share how their treks lead
                    to life-changing
                    decisions, often shifting the course of their lives in powerful and transformative ways.</p>
            </div>
            <div class="paradiv">
                <div class="heading"><b>Connect to Nature</b></div>
                <p class="p">Trekking connects you to nature, but true connection comes from knowing where to look. Our
                    treks
                    stand apart because our
                    trek leaders are trained naturalists. They don’t just guide you—they enrich your journey by sharing
                    the trails' flora,
                    fauna, and biodiversity, deepening your understanding of the natural world.</p>
            </div>
            <div class="paradiv">
                <div class="heading"><b>Connect to other</b></div>
                <p class="p">Trekking brings about deep friendships that often last a lifetime. In today’s fast-paced
                    world, these
                    connections are
                    invaluable. Our trek leaders focus on building these relationships from the start, creating a
                    close-knit community
                    united not just by the trail but by shared understanding and lasting friendships.</p>
            </div>
        </div>

        <div class="info">
            <h2>🌄 About Trekking</h2>
            <p>
                Trekking is not just about walking through mountains or forests – it's a journey into nature, adventure,
                and
                self-discovery.
            </p>
            <ul>
                <li>Reconnect with the natural world</li>
                <li>Build physical and mental endurance</li>
                <li>Discover hidden sights, waterfalls, valleys, lakes, and peaks</li>
                <li>Make unforgettable memories with fellow trekkers</li>
            </ul>
            <p>
                Trekking also teaches survival skills, teamwork, and resilience.
            </p>
            <b>“In every walk with nature, one receives far more than he seeks.”</b>

        </div>

        <h1 class="trail">TrailVibe Events</h1>
        <div class="brt">
        </div>


        <div class="outer">
            <div class="inner">
                <img class="imgclass" src="fort1.jpg" alt="Trek with us">
                <a class="link" href="event_booking.php?id">
                    Book
                </a>
            </div>
            <div class="inner">
                <img class="imgclass" src="fort.jpg" alt="Trek with us">
                <a class="link" href="event_booking.php?id">
                    Book
                </a>
            </div>
            <div class="inner">
                <img class="imgclass" src="fort 4.jpg" alt="Trek with us">
                <a class="link" href="event_booking.php?id">
                    Book
                </a>
            </div>
            <div class="inner">
                <img class="imgclass" src="fort 5.jpg" alt="Trek with us">
                <a class="link" href="event_booking.php?id">
                    Book
                </a>
            </div>
        </div>

        <br><br>

        
        <div class="wrapper">
            <div class="break"></div>
            <div class="week">Weekend Plan</div>
            <div class="break1"></div>
        </div>

        <br>

        <div class="anotherloop">

            <div class="btn">
                <i>🔍</i>
                <input type="text" placeholder="weekend trekking fort">
            </div>

            <div class="adventure">

                <?php while($row = mysqli_fetch_assoc($data)) { ?>

                <div class="card">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['trek_name']; ?>">


                    <div class="card-content">
                        <div class="title"><?php echo $row['trek_name']; ?></div>

                        <div class="location">
                            📍 <?php echo $row['location']; ?>
                        </div>

                        <div class="date">
                            📅 <?php echo date("d/m/Y", strtotime($row['trek_date'])); ?>
                        </div>

                        <div class="price">
                            ₹<?php echo $row['price']; ?>
                        </div>

                        <a class="link" href="Booking.php?id=<?php echo $row['id']; ?>">
                            Book
                        </a>
                    </div>
                </div>

                <?php } ?>

            </div>
        </div>
            


        </div>
        <div class="beyond">
            <img src="beyond.jpg" alt="Trek Image 3">
        </div>

        <div class="trekk">
            <div class="trek-title">Beyond the Trail</div>
            <div class="trail1">
                <div class="mini">
                    <img class="miniimg" src="BC.jpg" alt="Trek with us">
                </div>
                <div class="mini">
                    <img class="miniimg" src="NE.jpg" alt="Trek with us">
                </div>
                <div class="mini">
                    <img class="miniimg" src="LI.jpg" alt="Trek with us">
                </div>
                <div class="mini">
                    <img class="miniimg" src="LC.jpg" alt="Trek with us">
                </div>
            </div>
        </div>

        <div class="break">
        </div>

        <div class="eventend">
        </div>

        <h1 class="cat">Trek by Categories</h1>
        <div class="brt">
        </div>


        <div class="outercat">
            <div class="inner">
                <img class="imgcat" src="tc2.jpg" alt="Trek with us">
            </div>
            <div class="inner">
                <img class="imgcat" src="tc3.jpg" alt="Trek with us">
            </div>
            <div class="inner">
                <img class="imgcat" src="tc4.jpg" alt="Trek with us">
            </div>
            <div class="inner">
                <img class="imgcat" src="tc5.jpg" alt="Trek with us">
            </div>
            <div class="inner">
                <img class="imgcat" src="tc6.jpg" alt="Trek with us">
            </div>
        </div>

        <div class="benefit">
            <div><b>Benefits of Trekking</b></div>
            <div class="para">
                <p>Benefits of Trekking
                    Trekking or hiking is a recreational activity that has grown in popularity over the years. It's easy
                    to see why this
                    outdoor sport is so popular; it offers numerous benefits, both physically and mentally. Trekking can
                    make you more agile
                    by improving your muscle strength and cardiovascular endurance as well as boosting your
                    self-confidence through
                    overcoming obstacles and conquering new terrain.<br><br>

                    The benefits of trekking are many. It's a great way to get out in nature, bond with your kids and
                    family members, and
                    have some time for yourself. You'll also get to see some beautiful sights that you may never have
                    seen before!<br><br>

                    Hiking is a great way to get some fresh air and exercise while exploring the outdoors. If you're
                    looking for an
                    adventure, hiking can be a fun activity for people of all ages. Listed below are Benefits of
                    Trekking
                </p>

                <div class="list">
                    <ul type="disc">
                        <li>Trekking is a great way to explore new places</li>
                        <li>You can take your dog with you on the trail</li>
                        <li>It's an inexpensive activity that provides a lot of physical and mental benefits</li>
                        <li>You get to spend time outside, which has been shown to improve mood and reduce stress levels
                        </li>
                        <li>Trekking is a great way to get outside and enjoy the fresh air</li>
                        <li>It's an excellent form of exercise that can burn up to 1000 calories in just one hour</li>
                        <li>Trekking has been shown to lower blood pressure, reduce cholesterol levels, and improve
                            sleep quality</li>
                        <li>You'll be able to see some amazing sights while trekking like mountains, waterfalls,
                            wildlife (including endangered
                            species), etc</li>
                        <li>Trekking is a great way to get exercise</li>
                        <li>It's a good way to spend time with friends or family </li>
                        <li>Trekking can be done at any age</li>
                    </ul>
                </div>
            </div>
        </div>

        <a href="https://wa.me/8591241608?text=Hello%20I%20want%20to%20book%20a%20trek" class="whatsapp-btn" target="_blank">
            Book on WhatsApp
        </a>

        <div class="heading1">
            <div><b>Trekks near&nbsp;</b></div>
            <div class="hd"><b> You</b></div>
        </div>

        <div class="br1">
        </div>

        <div class="manybtn">
            <button class="button1">Junnar</button>
            <button class="button1">Nashik</button>
            <button class="button1">Pune</button>
            <button class="button1">Kolhapur</button>
            <button class="button1">Satara</button>
            <button class="button1">Jalgaon</button>
            <button class="button1">Mumbai</button>
            <button class="button1">Lonavala</button>
            <button class="button1">Ujjain</button>

        </div><br><br><br><br><br><br><br><br>

        <div class="image1">
            <img class="bgimg" src="trekking.jpg" alt="Trek with us">

            <div class="lastinfo">
                <img class="bgnimg" src="symbol.jpg" alt="Symbol">
                <div class="brook"></div>
                <div class="intern">
                    <div class="intern1">
                        <p>📞Phone</p>
                        <p>+914586235874</p>
                        <p>+914752315896</p>
                    </div>
                    <div class="intern2">
                        <p><b>✉ trekvibeinfo@gmail.com</b></p>
                    </div>
                    <div class="intern3">
                        <p>📍 Head Office -42 @Junnar shivaji maharaj road, Sector2</p>
                    </div>
                </div>

                <div class="int">
                    <div class="int1">
                        <p>©2025 TrekVibe <br>All Rights Reserved All Images are copyrighted, Usage of any
                            image
                            is restricted.</p>
                    </div>
                    <div class="int2">
                        <img class="bgimges" src="symbolic.jpg" alt="Trek with me">
                    </div>
                </div>


            </div>
        </div>
    </div>

    </div>

</body>

</html>