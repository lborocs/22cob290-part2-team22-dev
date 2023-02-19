<?php
include("../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];

$sql = "SELECT DISTINCT * FROM `projects` WHERE EXISTS (SELECT projectID FROM `taskToUserMapping` WHERE email = '$email' AND projects.projectID = taskToUserMapping.projectID) OR teamLeader = '$email'";
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