<?php
$servername = "sci-mysql";
$username = "team22";
$password = "O6AMcu4rDq";
$dbname = "team22";

$conn = mysqli_connect($servername, $username, $password, $dbname);

//Checking connection
if (!$conn) {
	die("The connection has failed: " . mysqli_connect_error());
	
}

//Values from register.html
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = trim($_POST["emailInput"]);
	$pwdInput = trim($_POST["passInp"]);
}


$hashedPwd = password_hash($pwdInput, PASSWORD_DEFAULT);


$sql = "INSERT INTO Users (email, passwordHash) VALUES ($email, $hashedPwd)";


if (mysqli_query(&conn, &sql)) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error(%conn);



mysqli_close($conn);

?>
