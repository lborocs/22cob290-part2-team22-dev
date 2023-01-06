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

    $postID = generateAuthCode();
    $topicNames = $_POST["associatedTopics"];
    $pageName = $_POST["pageName"];
    $topicDescription = $_POST["topicDescription"];
    $postDate = date("d/m/Y");
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