<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Make-It-All</title>
    <script src="/login/login.js"></script>
</head>
<body style="width:100% !important;">
<div class="container-fluid login-container">

    <h3 class="center title">Forgotten Password</h3>
    <div class="jumbotron form-jumbo">
    <div id = 'banner'></div>
        <form id="forgotForm">
            <div class="form-group">
              <label for="emailInput">Email Address</label>
              <input type="email" class="form-control" id="emailInput" name="emailInput">
              
            </div>
            <button type="submit" class="btn btn-success">Continue</button>
            <br>
            <br>
            <a class="center title" style=" font-size: smaller;" href="index.php">Return to login</a>
        </form>


    </div>
</div>
</div>    
</body>
</html>