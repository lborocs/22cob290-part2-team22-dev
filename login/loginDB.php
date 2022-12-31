<?php
session_start();

include("../DBCredentials.php");

$emailInput = $_POST['emailInput'];
$passwordInput = $_POST['passwordInput'];

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM users WHERE email = '$emailInput'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)>0){
    $account = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (password_verify($passwordInput, $account["passwordHash"])){
        $_SESSION['email'] = $account["email"];
        $_SESSION['isAdmin'] = $account["isAdmin"];
        echo "true";
    } else {
        echo "false";
    }
} else {
    echo "false";
}
?>