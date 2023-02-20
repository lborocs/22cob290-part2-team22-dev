<?php

    include("../DBCredentials.php");

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user = $_POST["user"];
    $task = $_POST["task"];
    $sql = "UPDATE toDo SET task = '$task' WHERE user = '$user'";
    $result = mysqli_query($conn, $sql);
    if ($result == false){
        $sql = "INSERT INTO toDo VALUES ('$user','$task')";
        $result = mysqli_query($conn, $sql);
        if ($result == false){
            echo "false";  
        }
        else {
            echo "true";
        }
    } else {
        echo "true";
    }
    mysqli_close($conn);
?>