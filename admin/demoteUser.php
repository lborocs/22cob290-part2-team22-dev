<?php
include("../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];

$sql = "UPDATE users SET isAdmin = '0' WHERE email = '$email';";
$result = mysqli_query($conn, $sql);
?>