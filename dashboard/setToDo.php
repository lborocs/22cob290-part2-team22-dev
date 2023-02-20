<?php

    include("../DBCredentials.php");

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user = $_POST["user"];
    $task = $_POST["task"];
    $sql = "INSERT INTO toDo (user,task) VALUES ('$user','$task') ON DUPLICATE KEY UPDATE task = '$task'";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
?>