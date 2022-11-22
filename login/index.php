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
</head>
<body style="width:100% !important;">
<div class="container-fluid login-container">

    <h3 class="center title">Sign in to Dashboard</h3>
    <div class="jumbotron form-jumbo">
        <form id="loginForm">
            <div class="form-group">
              <label for="emailInput">Email Address</label>
              <input type="email" class="form-control" id="emailInput" name="emailInput">
              
            </div>
            <div class="form-group">
                <div class="group">
              <label class="pass" for="passwordInput">Password</label>
              <a style=" font-size: smaller" href="http://">Forgot Password?</a>
            </div>
              
              <input type="password" class="form-control" id="passwordInput" name="passwordInput">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
        </form>


    </div>
    <script>
      $(document).ready(function () {

          $("#loginForm").submit(function(event){
            event.preventDefault();
            
            var email = $("#emailInput").val();
            var password = $("#passwordInput").val();

            $.ajax({
              url:"loginDB.php",
              type:"POST",
              data: {emailInput: email, passwordInput: password},
              success: function(responseData){
                console.log(responseData);
                if (responseData === "true"){
                  location.href = "../navbar.php";
                } else {
                  window.alert("Incorrect Credentials");
                }
              },
              error: function(e){
                  window.alert("Error Occurred! Please refer to console.");
                  console.log(e.message);
              }
            });
          });
      });
      </script>
</div>
</div>    
</body>
</html>