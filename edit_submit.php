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

//check required values were actually was posted
$PK = isset($_POST["PK"]) ? $_POST["PK"] : 0;
$PRODUCTNAME = isset($_POST["PRODUCTNAME"]) ? $_POST["PRODUCTNAME"] : 0;
$UNITS = isset($_POST["UNITS"]) ? $_POST["UNITS"] : 0;
$PRICE = isset($_POST["PRICE"]) ? $_POST["PRICE"] : 0;
$IMAGE = isset($_POST["IMAGE"]) ? $_POST["IMAGE"] : 0;
$DESCRIPTION = isset($_POST["DESCRIPTION"]) ? $_POST["DESCRIPTION"] : 0;

// sql to delete a record

$sql = "UPDATE PRODUCTS SET PRODUCTNAME='$PRODUCTNAME', UNITS='$UNITS', PRICE='$PRICE', IMAGE='$IMAGE', DESCRIPTION='$DESCRIPTION' WHERE PK='$PK'";
echo $sql;

if (mysqli_query($conn, $sql)) {
    echo "Record updated  successfully";
} else {
    echo "Error updating   record: " . mysqli_error($conn);
}

mysqli_close($conn);

//redirect back to customer page on success
header("Location: http://danu6.it.nuigalway.ie/BKelly/Assignment7/editStock.php");