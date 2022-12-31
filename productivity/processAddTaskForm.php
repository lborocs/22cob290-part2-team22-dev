<?php
    function generateAuthCode() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $authCode = '';
        for ($i = 0; $i < 6; $i++) {
            $authCode .= $characters[rand(0, $charactersLength - 1)];
        }
        return $authCode;
    }

    include("../DBCredentials.php");

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
    }

    $taskID = generateAuthCode();
    $projectID = $_POST["projectID"];
    $taskName = $_POST["taskName"];
    $taskStatus = $_POST["taskStatus"];
    $description = $_POST["description"];
    $manHours = $_POST['manHours'];
    $assignee = $_POST["assignee"];

    $sql = "INSERT INTO tasks VALUES ('$taskID', '$projectID', '$description', '$taskStatus', '$manHours', '$taskName');";
    $result = mysqli_query($conn, $sql);

    $sql = "INSERT INTO taskToUserMapping VALUES ('$assignee', '$taskID', '$projectID');";
    $result = mysqli_query($conn, $sql);
?>