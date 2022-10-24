<?php
    $taskName = $_POST["taskName"];
    $taskStatus = $_POST["taskStatus"];
    $linkedEpic = $_POST["linkedEpic"];
    $assignee = $_POST["assignee"];

    $file = fopen("testProject.txt", "a") or die("Unable to find file!");
    fwrite($file, $taskName."\n".$taskStatus."\n".$linkedEpic."\n".$assignee."\n");
    fclose($file);
?>