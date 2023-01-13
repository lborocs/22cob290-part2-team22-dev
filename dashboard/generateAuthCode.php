<?php
session_start();

include("../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$authCode = generateAuthCode();

$issueDate = date("Y-m-d");

$time = time();
$expiryDate = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time) +3 ,date("Y", $time)));

$recipientEmail = $_POST['recipientEmail'];

$senderEmail = $_SESSION['email'];

$sql = "INSERT INTO invites VALUES ('$authCode', '$recipientEmail', '$senderEmail', '$issueDate', '$expiryDate')";
$result = mysqli_query($conn, $sql);

if ($result == false){
    echo "false";
} else {
    echo $authCode;
}

?>