<?php
    $add = fileWriteAppend();
    file_put_contents('faq.json', $add);


    function fileWriteAppend(){
        $question = $_POST["question"];
        $answer = $_POST["answer"];
        $tags = $_POST["tags"];
		$current_data = file_get_contents('faq.json');
        $array_data = json_decode($current_data, true);
        if (!$array_data) {
            $id = 1;
        }
        else {
            $id = $array_data[count($array_data)-1]['id'] + 1;
        }
        $new = array('id' => $id,'question' => $question, 'answer' => $answer, 'tags'=>$tags);
		$array_data[] = $new;
		$final_data = json_encode($array_data);
		return $final_data;
}
?>