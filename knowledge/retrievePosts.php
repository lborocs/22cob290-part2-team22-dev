<?php
$file = fopen("posts.json", "r") or die("Unable to find file!");
$json_data = file_get_contents('posts.json');

echo $json_data;
?>