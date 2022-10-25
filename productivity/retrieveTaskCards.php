<?php
$file = fopen("testProject.txt", "r") or die("Unable to find file!");
$cards_array = array();

while(!feof($file)){
    $taskName = trim(fgets($file));
    $taskStatus = trim(fgets($file));
    $linkedEpic = trim(fgets($file));
    $assignee = trim(fgets($file));
    if ($taskName != ""){
        array_push($cards_array, array($taskName, $taskStatus, $linkedEpic, $assignee));
    }
}

echo json_encode($cards_array);
?>