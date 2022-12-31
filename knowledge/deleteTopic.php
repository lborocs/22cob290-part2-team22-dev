<?php
include("../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
$topicName = $_POST['topicName'];
$sql = "DELETE FROM topics WHERE topics.Name = '$topicName'";
$result = mysqli_query($conn, $sql);

if ($result == false){
    echo "false";
} else {
    echo "true";
}
?>