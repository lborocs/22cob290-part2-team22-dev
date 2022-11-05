<?php 

$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];
$subject = $_POST["subject"];

  $body = "Name: $name.\n"
    "User Email: $email.\n".
    "User Message: $message.\n";


$to = "bendadzie03@gmail.com";


mail($to,$subject,$body);
header("Location: contactadmin.html");
    
?>
