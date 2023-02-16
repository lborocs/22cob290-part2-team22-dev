<?php
include("../DBCredentials.php");



$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$projectID = $_POST['projectID'];

switch ($_POST['status']) {
    case "TODO":
        $status = 0;
        break;
    case "SELECTED":
        $status = 1;
        break;
    case "IN PROGRESS":
        $status = 2;
        break;
    case "COMPLETED":
        $status = 3;
        break;
    default:
        echo "false";
        break;
}

$sql = "SELECT * FROM tasks WHERE projectID = '$projectID' AND status = '$status'";
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