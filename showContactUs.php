<!DOCTYPE html>
<html>
<head>
    <?php
    /* login prompt on all pages */
    if ((isset($_SERVER['PHP_AUTH_USER']) == true) && (strtolower($_SERVER['PHP_AUTH_USER']) == 'admin') && (strtolower($_SERVER['PHP_AUTH_PW']) == 'admin')) {
        //login ok (admin/admin)
    } else {
        header('WWW-Authenticate: Basic realm="Funky Footware contact"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Funky Footware admin panel requires a login';
        exit;
    }
    /* login prompt on all pages */
    ?>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" >
    <title>Home</title>
    <script type="text/javascript">
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('clock').innerHTML =
                h + ":" + m + ":" + s;
            var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10)
            {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
    </script>

</head>
<body  onload="startTime()" "carousel();">
<div class = "photoheader"></div>
<div class = "header">
    <h1 style="background-color:#999999; color:#EEEEEE; font-size:60px; padding: 30px; margin: 0px; text-align:center ">Funky Footware
        <div id="clock">
        </div>
    </h1>
</div>
<div class="banner">
    <div id="bannerleft">
        &nbsp
    </div>
    <div class="slider">
        <img class="mySlides" src="ShoeBasket.jpeg" style="width:100%">
        <img class="mySlides" src="OutDoorShoes.jpeg" style="width:100%">
        <img class="mySlides" src="LeatherShoes.jpeg" style="width:100%">
        <img class="mySlides" src="SummerShoes.jpeg" style="width:100%">
    </div>
    <div id= "bannerright">
        &nbsp
    </div>
    <script type="text/javascript">
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {myIndex = 1}
            x[myIndex-1].style.display = "block";
            setTimeout(carousel, 2000); // Change image every 2 seconds
        }
    </script>
</div>

<div class= "content">
    <!--Navigation Area-->
    <div class="nav">

        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="contact.php">Contact Information</a></li>
            <li><a href="offers.html">Special Offers</a></li>
            <li><a href="links.html">Useful Links</a></li>
        </ul>
    </div>
    <!--Main Content Area-->
    <div class="main" >
        <?php
        $servername = "danu6.it.nuigalway.ie";
        $username = "mydb2585a";
        $password = "mydb2585a";
        $dbname = "mydb2585";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT *  FROM MyForm";
        $result = mysqli_query($conn, $sql);

        if ($result === FALSE) {
            die(mysqli_connect_error());
        }

        echo "<table>";
        echo "<tr><td>TICKET NO</td><td>NAME</td><td>QUERY</td><td>EMAIL</td><td>DEPT</td><td>NOTE</td></tr>";

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["PK"] .

                    "</td><td>" . $row["CONTACT_NAME"] .

                    "</td><td>" . $row["QUESTION"] .

                    "</td><td>" . $row["EMAIL_ADDRESS"] .

                    "</td><td>" . $row["CATEGORY"] .

                    "</td><td>" . $row["NOTE"] .

                    "</td>" .

                    "<td class='query-note'>
                            <form action='note.php?PK=" . $row["PK"] . "' method='post'>" .
                    "<input type='hidden' name='name' value='<?php echo " . $row["PK"] . "; ?>'>" .
                    "<input type='submit' name='submit' value='Note'>
                            </form>
                        </td>" .

                    "<td class='query-delete'>
                            <form action='delete.php?PK=" . $row["PK"] . "' method='post'>" .
                    "<input type='hidden' name='name' value='<?php echo " . $row["PK"] . "; ?>'>" .
                    "<input type='submit' name='submit' value='Delete'>
                            </form>
                        </td></tr>";
            }
        } else {
            echo "0 results";
        }

        echo "</table>";

        mysqli_close($conn);
        ?>
        <br>
        <br>
        <br>
        <br><br><br><br><br><br>
    </div>
    <!--Other Content Area-->
    <div class="othercontent">
    </div>
</div>
<!--Footer Area-->
<div class="footer" >
    This page 'Funky Footware' was created as part of an 'Internet Programming' module CT870
</div>
</body>
</html>