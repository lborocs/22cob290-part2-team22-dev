<?php
$file = fopen("faq.json", "r") or die("Unable to find file!");
$json_data = file_get_contents('faq.json');

echo $json_data;
?>