<?php
function generateAuthCode() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $authCode = '';
    for ($i = 0; $i < 6; $i++) {
        $authCode .= $characters[rand(0, $charactersLength - 1)];
    }
    return $authCode;
}

$authCode = generateAuthCode();

$file = fopen("../generalFiles/AuthCodes.txt","a") or die("Unable to find file!");
fwrite($file, $authCode."\n");
fclose($file);

echo(json_encode($authCode));
?>