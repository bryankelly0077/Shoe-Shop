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

// sql to delete a record
$sql = "DELETE FROM MyForm WHERE PK = '$PK'";

if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);

//redirect back to customer page on success
header("Location: http://danu6.it.nuigalway.ie/BKelly/Assignment6/showContactUs.php");
