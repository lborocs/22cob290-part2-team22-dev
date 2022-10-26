<?php
    $add = fileWriteAppend();
    file_put_contents('testProject.json', $add);


    function fileWriteAppend(){
        $taskName = $_POST["taskName"];
        $taskStatus = $_POST["taskStatus"];
        $linkedEpic = $_POST["linkedEpic"];
        $assignee = $_POST["assignee"];
		$current_data = file_get_contents('testProject.json');
		$array_data = json_decode($current_data, true);
        $new = array('taskName' => $taskName, 'taskStatus' => $taskStatus, 'linkedEpic' => $linkedEpic, 'assignee' => $assignee);
		$array_data[] = $new;
		$final_data = json_encode($array_data);
		return $final_data;
}
?>