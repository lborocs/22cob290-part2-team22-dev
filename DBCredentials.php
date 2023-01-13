<?php
// Use for ID
function generateAuthCode() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $authCode = '';
    for ($i = 0; $i < 6; $i++) {
        $authCode .= $characters[rand(0, $charactersLength - 1)];
    }
    return $authCode;
}

//When using sci-project for development!!
$servername = "sci-project";
$username = "colmt";
$password = "Gn63O4FwYP";
$dbname = "colmt";

//When on Google Server!!
// $servername = "localhost";
// $username = "root";
// $password = "57893910-2a46-4f80-b229-1eab9dcdb1b2";
// $dbname = "makeItAll";
?>