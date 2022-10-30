<?php
    $add = fileWriteAppend();
    file_put_contents('testProject.json', $add);
    function fileWriteAppend(){
        $id = $_POST["id"];
        $taskStatus = $_POST["taskStatus"];
		$current_data = file_get_contents('testProject.json');
        $array_data = json_decode($current_data, true);
        for ($i = 0; $i < count($array_data); $i++) {
            if ($array_data[$i]['id'] == $id) {
                $array_data[$i]['taskStatus'] = $taskStatus;
            }
        }
		$final_data = json_encode($array_data);
		return $final_data;
}
?>