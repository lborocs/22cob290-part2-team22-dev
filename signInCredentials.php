<?php
$email = "admin@make-it-all.com";
$password = "\$2y\$10\$ZdPreyZwyuSEOedNetINUeicnlgMZC5zhBV2QoicUe3oGmyYFa39S";
$emailInput = $_POST['emailInput'];
$passwordInput = $_POST['passwordInput'];

if(password_verify($passwordInput, $password) and $emailInput == $email){
    echo "<script>window.alert(\"Correct Password\")</script>";
    header("Location: /dashboard.html");
    die();
} else {
    echo "<script>window.alert(\"Incorrect Password\")</script>";
    header("Location: /index.html");
    die(); 
}
?>