<?php
include("../../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$projectID = $_POST["projectID"];

$sql = "DELETE FROM tasks WHERE projectID = '$projectID'";
$result = mysqli_query($conn, $sql);

$sql = "DELETE FROM taskToUserMapping WHERE projectID = '$projectID'";
$result = mysqli_query($conn, $sql);

$sql = "DELETE FROM projects WHERE projectID = '$projectID'";
$result = mysqli_query($conn, $sql);
?>