<?php
include("../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$taskID = $_POST["taskID"];
$projectID = $_POST["projectID"];
$assignee = $_POST["newAssignee"];

$sql = "SELECT email FROM users WHERE email = '$assignee'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)>0){
    $sql = "INSERT INTO taskToUserMapping VALUES ('$assignee','$taskID','$projectID');";
    $result = mysqli_query($conn, $sql);
}

echo $result;
?>