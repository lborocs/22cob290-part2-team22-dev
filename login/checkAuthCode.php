<?php
$authCodeInput = $_POST['AuthCode'];

//Open AuthCodes text file and initialise array
$file = fopen("../generalFiles/AuthCodes.txt", "r") or die("Unable to find file!");
$authCode_array = array();
//////////////////////////////////////////////////

//Getting all Atuhcodes from AuthCodes.txt
while(!feof($file)) {
    $authCode = trim(fgets($file));
    array_push($authCode_array, $authCode);
}
//////////////////////////////////////////

fclose($file);

//Searching for matching AuthCode
for ($i = 0; $i < count($authCode_array); $i++){
    $authCode = $authCode_array[$i];

    if($authCodeInput === $authCode){
        unset($authCode_array[$i]);
        $file = fopen("../generalFiles/AuthCodes.txt", "w");
        foreach($authCode_array as $temp){
            fwrite($file, $temp."\n");
        }
        fclose($file);
        echo "true";
        die();
    }
}
/////////////////////////////////////////////////////////////////

//If no matching authcode, return false

echo "false";
///////////////////////////////////////////////
?>