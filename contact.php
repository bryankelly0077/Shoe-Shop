<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <title>Home</title>

    <script type="text/javascript">
        /*
         function validate(){
         if(myform.question.value.length<25) {
         window.alert("Please enter a question with at least 25 characters ");
         }
         if(myform.name.value.length<10) {
         window.alert("Please enter a name with at least 10 characters");
         }
         var e = myform.email.value;
         if((e.length<10)||(e.indexOf("@")<0)||(e.indexOf(".")<0)) {
         window.alert("Please enter at least 10 characters and include the symbols @ and . in email address");
         }
         else {
         window.alert("Your question will be dealt with as soon as possible")
         }
         }*/
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
            if (i < 10) {
                i = "0" + i
            }
              // add zero in front of numbers < 10
            return i;
        }
    </script>
</head>
<body onload="startTime()"
"carousel();">
<div class="photoheader"></div>
<div class="header">

    <h1 style="background-color:#999999; color:#EEEEEE; font-size:60px; padding: 30px; margin: 0px; text-align:center">
        Funky Footware
        <div id="clock"></div>
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
    <div id="bannerright">
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
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 2000); // Change image every 2 seconds
        }
    </script>
</div>

<div class="content">
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
    <div class="main">

        <?php

        $servername = "danu6.it.nuigalway.ie";
        $username = "mydb2585a";
        $password = "mydb2585a";
        $dbname = "mydb2585";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error()."<br>");
        } else {
            echo "Connected successfully <br>";
        }
        // define variables and set to empty values
        $nameErr = $emailErr = $questionErr = $categoriesErr = "";
        $name = $email = $question = $categories = "";
        $validname = $validemail = $validquestion = $validcategories = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Name is required";

            } elseif (strlen($_POST["name"]) < 10) {
                $nameErr = "Name must be more than 10 charachters";
            } else {
                $name = test_input($_POST["name"]);
                $validname = true;
            }

            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } elseif (strlen($_POST["email"]) < 10) {
                $emailErr = "Email must be more than 10 charachters";
            } elseif (strpos($_POST["email"], '@') === false) {
                $emailErr = "Email must have @ symbol";
            } elseif (strpos($_POST["email"], '.') === false) {
                $emailErr = "Email must contain a '.'";
            } else {
                $email = test_input($_POST["email"]);
                $validemail = true;
            }


            if (empty($_POST["question"])) {
                $questionErr = "question is required";
            } elseif (strlen($_POST["question"]) < 25) {
                $question = test_input($_POST["question"]);
                $questionErr = "Question must have at least 25 charachters";
            } else {
                $question = test_input($_POST["question"]);
                $validquestion = true;
            }
            if (empty($_POST["categories"])) {
                $categoriesErr = "categories is required";
            } else {
                $categories = test_input($_POST["categories"]);
                $validcategories = true;
            }
        }
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($validname === true && $validemail === true && $validquestion === true && $validcategories === true) {
            @$sql = "INSERT INTO MyForm (QUESTION,CONTACT_NAME,EMAIL_ADDRESS,CATEGORY) VALUES ('$question','$name','$email','$categories')";

            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully <br>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn)."<br>";
            }

            mysqli_close($conn);
            $to = "bryankelly0077@gmail.com";
            $subject = $categories;
            $message = "From " . $name . "\nQuestion " . $question . "\nEmail " . $email;
            @$send = mail($to, $subject, $message);
        }

        ?>
        <h1>Contact Information</h1>
        <table id="qform">
            <form name=myform method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <tr>
                    <th colspan="2">Please submit your questions below</th>
                </tr>
                <tr>
                    <td>
                        Choose Category
                        <br>
                        <select name="categories" value="<?php echo $categories; ?>">
                            <option value="sales">sales</option>
                            <option value="returns">returns</option>
                            <option value="shipping">shipping</option>
                            <option value="payment">payment</option>
                            <option value="vouchers">vouchers</option>
                        </select>
                    </td>
                    <td>
                        Please enter your question:<br>
                        <span class="error">* <?php echo $questionErr; ?></span>
                        <textarea name="question" rows=3 cols=40><?php echo $question; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        Please enter your name:<br>
                        <span class="error">* <?php echo $nameErr; ?></span>
                        <input type="text" name="name" value="<?php echo $name; ?>" size="20">
                    </td>
                    <td>
                        Please enter your Email address:<br>
                        <span class="error">* <?php echo $emailErr; ?></span>
                        <input type="text" name="email" value="<?php echo $email; ?>" size="20"><br><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Submit" ;><br><br>
                    </td>
                </tr>
            </form>
        </table>
        <?php

        if (@$send) {
            echo "mail sent";
        } else {
            echo "question not sent";
        }

        ?>
        <div class=contact>
            <dl>
                <div class=info>
                    <dt>
                    <h3> Fulfilment Executive</h3> <h4>Micky Mack</h4> </dt>
                    <dd><h5>Phone Number</h5>091123455</dd>
                    <dd><h5>Email</h5> <a href="mailto:m.mack@funkyfootware.ie">m.mack@funkyfootware.ie</a></dd>
                </div>
                <div class=info>
                    <dt>
                    <h3> Marketing Officer</h3> <h4>Johnny Stones</h4> </dt>
                    <dd><h5>Phone Number</h5>091123456</dd>
                    <dd><h5>Email</h5> <a href="mailto:j.stones@funkyfootware.ie">j.stones@funkyfootware.ie</a></dd>
                </div>
                <div class=info>
                    <dt>
                    <h3> Secretary</h3> <h4>Molly Williams</h4> </dt>
                    <dd><h5>Phone Number</h5>091123457</dd>
                    <dd><h5>Email</h5> <a href="mailto:m.williams@funkyfootware.ie">m.williams@funkyfootware.ie</a></dd>
                </div>
            </dl>
        </div>
    </div>
    <!--Other Content Area-->
    <div class="othercontent">
    </div>
</div>
<!--Footer Area-->
<div class="footer">
    This page 'Funky Footware' was created as part of an 'Internet Programming' module CT870
</div>
</body>
</html>