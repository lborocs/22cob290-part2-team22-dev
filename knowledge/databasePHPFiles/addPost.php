<?php

    include("../../DBCredentials.php");

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $postID = generateAuthCode();
    $topicNames = $_POST["associatedTopics"];
    $pageName = $_POST["pageName"];
    $topicDescription = $_POST["topicDescription"];
    $postDate = date("Y/m/d");
    $author = $_POST["author"];
    $sql = "INSERT INTO posts VALUES ('$postID', '$pageName', '$topicDescription','$postDate','$author')";
    $result = mysqli_query($conn, $sql);
    $sql = "INSERT INTO topicToPostMapping VALUES ((SELECT topicID FROM topics WHERE topics.name = '$topicNames'),'$postID')";
    $result = mysqli_query($conn, $sql);
    if ($result == false){
        echo "false";
    } else {
        echo "true";
    }
?>