<?php

$emailInput = $_POST['emailInput'];
$passwordInput = $_POST['passwordInput'];
$hash = password_hash($passwordInput, PASSWORD_DEFAULT);

$newUser = array("email"=>$emailInput, "passwordHash"=>$hash, "isAdmin"=>false);

//Grabbing the json users array and appending the new user to it
$file = file_get_contents("../generalFiles/users.json") or die("Unable to find file!");
$json = json_decode($file,true);
array_push($json, $newUser);

//Writing to the json file
$temp = fopen("../generalFiles/users.json","w");
fwrite($temp,json_encode($json));
fclose($temp);

header("Location: ../navbar.php");
die();

// WHEN WE START TO USE THE DB REPLACE WITH - 

// $servername = "sci-mysql";
// $username = "team22";
// $password = "O6AMcu4rDq";
// $dbname = "team22";

// $conn = mysqli_connect($servername, $username, $password, $dbname);

// //Checking connection
// if (!$conn) {
// 	die("The connection has failed: " . mysqli_connect_error());
	
// }

// //Values from register.html
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// 	$email = trim($_POST["emailInput"]);
// 	$pwdInput = trim($_POST["passInp"]);
// }


// $hashedPwd = password_hash($pwdInput, PASSWORD_DEFAULT);


// $sql = "INSERT INTO Users (email, passwordHash) VALUES ($email, $hashedPwd)";


// if (mysqli_query(&conn, &sql)) {
// 	echo "New record created successfully";
// } else {
// 	echo "Error: " . $sql . "<br>" . mysqli_error(%conn);



// mysqli_close($conn);
 

?>