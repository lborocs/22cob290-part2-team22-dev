<?php
$emailInput = $_POST['emailInput'];
$passwordInput = $_POST['passwordInput'];

//Open Users text file and initialise users array
$file = fopen("../users.txt", "r") or die("Unable to find file!");
$users_array = array();
//////////////////////////////////////////////////

//Getting all user details from users.txt
while(!feof($file)) {
    $email = trim(fgets($file));
    $password = trim(fgets($file));
    array_push($users_array, array($email, $password));
}
//////////////////////////////////////////


//Searching if there is a user with matching email and password
for ($i = 0; $i < count($users_array); $i++){
    $email = $users_array[$i][0];
    $password = $users_array[$i][1];

    //If yes, redirect to dashboard
    if(password_verify($passwordInput, $password) and $emailInput === $email){
        echo "<script>window.alert(\"Correct Credentials\")</script>";
        header("Location: /dashboard/dashboard.php");

        die();
    }
    ///////////////////////////////
}
/////////////////////////////////////////////////////////////////

//If no matching user, redirect to sign in page

echo "<script>window.alert(\"Incorrect Credentials\")</script>";
header("Location: /login/index.html");

die(); 
///////////////////////////////////////////////
?>