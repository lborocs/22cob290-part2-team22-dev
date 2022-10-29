<?php
session_start();

$emailInput = $_POST['emailInput'];
$passwordInput = $_POST['passwordInput'];

//Open Users text file and initialise users array
$file = file_get_contents("../generalFiles/users.json") or die("Unable to find file!");
$json = json_decode($file,true);
//////////////////////////////////////////////////

//Searching if there is a user with matching email and password
foreach ($json as $user){
    $email = $user['email'];
    $password = $user['passwordHash'];
    $isAdmin = $user['isAdmin'];

    //If yes, redirect to dashboard
    if(password_verify($passwordInput, $password) and $emailInput === $email){
        $_SESSION['email'] = $email;
        $_SESSION['isAdmin'] = $isAdmin;
        echo "<script>window.alert(\"Correct Credentials\")</script>";
        header("Location: ../navbar.php");

        die();
    }
    ///////////////////////////////
}
/////////////////////////////////////////////////////////////////

//If no matching user, redirect to sign in page

//echo "<script>window.alert(\"Incorrect Credentials\")</script>";
header("Location: index.php");

die(); 
///////////////////////////////////////////////
?>