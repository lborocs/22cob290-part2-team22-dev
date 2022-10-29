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
        if (!$array_data) {
            $id = 1;
        }
        else {
            $id = $array_data[count($array_data)-1]['id'] + 1;
        }
        $new = array('id' => $id,'taskName' => $taskName, 'taskStatus' => $taskStatus, 'linkedEpic' => $linkedEpic, 'assignee' => $assignee);
		$array_data[] = $new;
		$final_data = json_encode($array_data);
		return $final_data;
}
?>