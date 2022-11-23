<?php

$emailInput = trim($_POST['emailInput']);
$passwordInput = trim($_POST['passwordInput']);
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

$sql = "INSERT INTO users VALUES ('$emailInput', '$hash', 0)";


if (mysqli_query($conn, $sql)) {
	echo "New record created successfully";

    $inviteCode = trim($_POST['inviteCode']);
    $sql = "DELETE FROM invites WHERE inviteCode = '$inviteCode'";
    mysqli_query($conn, $sql);

    mysqli_close($conn);
    header("Location: ../navbar.php");
    die();
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);

}

?>