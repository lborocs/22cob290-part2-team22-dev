<?php

include("../../DBCredentials.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
$postID = $_POST['postId'];
$sql = "DELETE FROM posts WHERE posts.postID = '$postID'";
$result = mysqli_query($conn, $sql);

if ($result == false){
    echo "false";
} else {
    echo "true";
}
?>