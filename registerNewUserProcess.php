<?php
$emailInput = $_POST['emailInput'];
$passwordInput = $_POST['passwordInput'];
$hash = password_hash($passwordInput, PASSWORD_DEFAULT);

$file = fopen("users.txt", "a") or die("Unable to find file!");
fwrite($file,"\n".$emailInput."\n");
fwrite($file, $hash);
fclose($file);

header("Location: /dashboard.php");
die();
?>