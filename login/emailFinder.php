<?php
session_start();


$servername = "sci-project";
$username = "colmt";
$password = "Gn63O4FwYP";
$dbname = "colmt";

$emailInput = $_POST['emailInput'];

function generateForgotPasswordCode() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $authCode = '';
    for ($i = 0; $i < 6; $i++) {
        $authCode .= $characters[rand(0, $charactersLength - 1)];
    }
    return $authCode;
}


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM users WHERE email = '$emailInput'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)>0){
    $getCode = generateForgotPasswordCode();
    $sqlup = "UPDATE users SET forgotPWD = '$getCode' WHERE email = '$emailInput'";
    $result = mysqli_query($conn, $sqlup);
    if ($result == false) {
        echo "false";
    }
    else {
        $subject = "Reset Password";
        $message = "<h1>Make It All</h1>";
        $message .= "<b>Forgot Password?</b><br>";
        $message .= "<a href = 'http://coja.sci-project.lboro.ac.uk/teamProject/login/resetPassword.php?resetCode=$getCode'>Click Here </a>";
        
        $header = "From:support@makeitall.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
    
        mail ($emailInput,$subject,$message,$header);
        echo "true";
    }
} else {
    echo "false";
}
?>