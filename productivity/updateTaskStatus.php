<?php
include("../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$taskID = $_POST["taskID"];
$projectID = $_POST["projectID"];
$newStatus = $_POST["newStatus"];

$sql = "UPDATE tasks SET status = '$newStatus' WHERE taskID = '$taskID' AND projectID = '$projectID';";
$result = mysqli_query($conn, $sql);
?>