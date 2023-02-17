<?php
include("../../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST["topicName"];
$sql = "SELECT * FROM posts WHERE postID IN (SELECT postID FROM topicToPostMapping WHERE topicID = (SELECT topicID FROM topics WHERE topics.name = '$name'))";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)>0){
    $allDataArray = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $allDataArray[] = $row;
    }
    echo json_encode($allDataArray);
} else {
    echo "false";
}


?>