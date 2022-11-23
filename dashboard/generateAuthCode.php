<?php
session_start();
function generateAuthCode() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $authCode = '';
    for ($i = 0; $i < 6; $i++) {
        $authCode .= $characters[rand(0, $charactersLength - 1)];
    }
    return $authCode;
}

$servername = "sci-project";
$username = "colmt";
$password = "Gn63O4FwYP";
$dbname = "colmt";

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