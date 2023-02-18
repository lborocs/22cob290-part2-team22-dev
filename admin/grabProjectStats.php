<?php
include("../DBCredentials.php");



$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$projectID = $_POST['projectID'];

$sql = "SELECT tasks.status FROM tasks WHERE projectID = '$projectID'";
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