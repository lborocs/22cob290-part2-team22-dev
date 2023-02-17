<?php

include("../../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$topicID = generateAuthCode();
$topicName = $_POST["topicName"];  
$technical = $_POST["technical"];
$sql = "INSERT INTO topics VALUES ('$topicID', '$topicName', '$technical')";
$result = mysqli_query($conn, $sql);

if ($result == false){
    echo "false";
} else {
    echo "true";
}
?>