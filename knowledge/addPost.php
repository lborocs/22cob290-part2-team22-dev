<?php
    $add = fileWriteAppend();
    file_put_contents('posts.json', $add);


    function fileWriteAppend(){
        $title = $_POST["title"];
        $content = $_POST["content"];
        $currentDate = $_POST["currentDate"];
        $user = $_POST["user"];
        $tags = $_POST["tags"];
		$current_data = file_get_contents('posts.json');
        $array_data = json_decode($current_data, true);
        if (!$array_data) {
            $id = 1;
        }
        else {
            $id = $array_data[count($array_data)-1]['id'] + 1;
        }
        $new = array('id' => $id,'title' => $title, 'body' => $content, 'from'=>$user,'tags'=>array($tags), 'lastUpdated' => $currentDate, 'lastUpdatedBy' => $user, 'comments' => array());
		$array_data[] = $new;
		$final_data = json_encode($array_data);
		return $final_data;
}
?>