<?php

include("../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$taskID = $_POST["taskID"];
$projectID = $_POST["projectID"];
$taskName = $_POST["taskName"];
$description = $_POST["description"];

$sql = "UPDATE tasks SET taskName = '$taskName', description = '$description' WHERE taskID = '$taskID' AND projectID = '$projectID';";
$result = mysqli_query($conn, $sql);
?>