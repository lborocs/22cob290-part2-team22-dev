<?php

    include("../../DBCredentials.php");

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $commentID = generateAuthCode();
    $author = $_POST["author"];
    $comment = $_POST["comment"];
    $postDate = date("Y/m/d");
    $postId = $_POST["postId"];
    $sql = "INSERT INTO comments VALUES ('$commentID', '$author', '$comment','$postDate','$postId')";
    $result = mysqli_query($conn, $sql);
    if ($result == false){
        echo "false";
    } else {
        echo "true";
    }
?>