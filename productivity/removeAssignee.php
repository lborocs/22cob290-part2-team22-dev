<?php
include("../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$taskID = $_POST["taskID"];
$projectID = $_POST["projectID"];
$assignee = $_POST["user"];

$sql = "DELETE FROM taskToUserMapping WHERE email = '$assignee' AND taskID = '$taskID' AND projectID = '$projectID';";
$result = mysqli_query($conn, $sql);
?>