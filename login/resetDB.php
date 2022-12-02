<?php
$passwordInput = trim($_POST['passwordInput']);
$forgotPWD = $_POST['forgotPWD'];
$hash = password_hash($passwordInput, PASSWORD_DEFAULT);

// WHEN WE START TO USE THE DB REPLACE WITH - 

$servername = "sci-project";
$username = "colmt";
$password = "Gn63O4FwYP";
$dbname = "colmt";

$conn = mysqli_connect($servername, $username, $password, $dbname);

//Checking connection
if (!$conn) {
	die("The connection has failed: " . mysqli_connect_error());
}

$sql = "UPDATE users SET passwordHash = '$hash' WHERE forgotPWD = '$forgotPWD'";


if (mysqli_query($conn, $sql)) {

    $sql = "UPDATE users SET forgotPWD = 'None' WHERE forgotPWD = '$forgotPWD'";
    mysqli_query($conn, $sql);

    mysqli_close($conn);
    echo "true";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);

}

?>