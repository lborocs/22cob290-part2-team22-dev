<?php
    include("../../DBCredentials.php");

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $taskID = $_POST['taskID'];
    $projectID = $_POST['projectID'];
    
    $sql = "SELECT taskName, description FROM tasks WHERE tasks.projectID = '$projectID' AND tasks.taskID = '$taskID'";
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