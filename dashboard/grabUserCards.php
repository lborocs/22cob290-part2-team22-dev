<?php
$info = file_get_contents("../generalFiles/users.json") or die("Unable to find file!");
echo $info;
?>