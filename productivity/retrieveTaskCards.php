<?php
$file = fopen("testProject.json", "r") or die("Unable to find file!");
$json_data = file_get_contents('testProject.json');

echo $json_data;
?>