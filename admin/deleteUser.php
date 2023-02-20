<?php
include("../../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];

$sql = "DELETE FROM taskToUserMapping WHERE email = '$email';";
$result = mysqli_query($conn, $sql);

$sql = "DELETE FROM users WHERE email = '$email';";
$result = mysqli_query($conn, $sql);
?>