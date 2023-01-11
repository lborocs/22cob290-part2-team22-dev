<?php

include("../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$projectID = generateAuthCode();
$teamLeader = $_POST["teamLeader"];
$startDate = date("Y-m-d");
$deadline = $_POST["deadline"];
$projectName = $_POST["projectName"];

$sql = "INSERT INTO projects VALUES ('$projectID', '$teamLeader', '$startDate', '$deadline', '$projectName')";
$result = mysqli_query($conn, $sql);

if ($result == false){
    echo "false";
} else {
    echo "true";
}
?>