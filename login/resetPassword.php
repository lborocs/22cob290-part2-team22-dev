<?php
session_start();
session_destroy();
if(isset($_GET['resetCode'])){
  $record = $_GET['resetCode'];
  if ($record == "false"){
    header("Location: /login/index.php");
    die();
  }
}
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
    <script src="/login/login.js"></script>
    <title>Make-It-All</title>
</head>
<body style="width:100% !important;">
<div class="container-fluid login-container">

    <h3 class="center title">Reset Password</h3>
    <div class="jumbotron form-jumbo">
      <div id = 'banner'></div>
        <form id="resetForm" onsubmit="return validateForm()">
            <div class="form-group">
              <label for="password">New Password</label>
              <input type="password" class="form-control" id="passwordInput" name="passwordInput">
              <br>
              <span id="StrengthDisp" class="badge displayBadge"></span>
              <label for="password">Re-enter Password</label>
              <input type="password" class="form-control" id="passwordMatchInput" name="passwordMatchInput">
            </div>
            <button type="submit" class="btn btn-success">Continue</button>
            <br>
            <a class="center title" style=" font-size: smaller;" href="index.php">Return to login</a>
        </form>

    </div>
</div>
</div>    
</body>
</html>