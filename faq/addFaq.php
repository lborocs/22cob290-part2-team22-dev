<?php

    include("../DBCredentials.php");

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $faqId = generateAuthCode();
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $image = $_POST['image'];
    $sql = "INSERT INTO FAQ VALUES ('$faqId', '$question', '$answer','$image')";
    $result = mysqli_query($conn, $sql);
    if ($result == false){
        echo "false";
    } else {
        echo "true";
    }
?>