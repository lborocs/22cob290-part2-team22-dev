<?php
include("../../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$projectID = $_POST['projectID'];
$email = $_POST['email'];

$sql = "SELECT taskID, taskName, status FROM tasks WHERE projectID = '$projectID' AND EXISTS (SELECT * FROM taskToUserMapping WHERE email = '$email' AND tasks.projectID = taskToUserMapping.projectID AND tasks.taskID = taskToUserMapping.taskID)";
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