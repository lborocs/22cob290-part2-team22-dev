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
    <script>
      let timeout;
      const password = document.getElementById('passwordInput');
      const strengthBadge = document.getElementById('StrengthDisp');
      const strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})')
      const mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))')


      function StrengthChecker(PasswordParameter){
        if(strongPassword.test(PasswordParameter)) {
            strengthBadge.style.backgroundColor = "green"
            strengthBadge.textContent = 'Strong'
        } else if(mediumPassword.test(PasswordParameter)){
            strengthBadge.style.backgroundColor = 'blue'
            strengthBadge.textContent = 'Medium'
        } else{
            strengthBadge.style.backgroundColor = 'red'
            strengthBadge.textContent = 'Weak'
        }
      }
      password.addEventListener("input", () => {

        strengthBadge.style.display= 'block'
        clearTimeout(timeout);

        timeout = setTimeout(() => StrengthChecker(password.value), 500);

        if(password.value.length !== 0){
            strengthBadge.style.display != 'block'
        } 
        else{
            strengthBadge.style.display = 'none'
        }
      });

      function validateForm() {
        const strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})')
        const email = document.getElementById('emailInput')
        const passwordInput = document.getElementById('passwordInput')
        const passwordMatchInput = document.getElementById('passwordMatchInput')
        if (passwordInput.value != passwordMatchInput.value) {
          document.getElementById('banner').innerHTML = `<div class="alert alert-warning" role="alert">Passwords must match!</div>`;
          return false;
        }
        if (!(strongPassword.test(passwordInput.value))) {
          document.getElementById('banner').innerHTML = `<div class="alert alert-warning" role="alert">Must have strong password</div>`;
          return false;
        }
        else {
          return true;
        }
      }

      $(document).ready(function () {

          $("#resetForm").submit(function(event){
            if (validateForm() == true) {
              event.preventDefault();
              var password = $("#passwordInput").val();
              var forgotPWD = '<?php echo $record?>';
              $.ajax({
                url:"resetDB.php",
                type:"POST",
                data: {passwordInput: password, forgotPWD: forgotPWD},
                success: function(responseData){
                  console.log(responseData);
                  if (responseData === "true"){
                    $( "#passwordInput" ).prop( "disabled", true );
                    $( "#passwordMatchInput" ).prop( "disabled", true );
                    $(".btn").css("display","None");
                    document.getElementById('banner').innerHTML = `<div class="alert alert-success" role="alert">Your password has been reset! You can now login</div>`;
                  } else {
                    window.alert("An error occured");
                  }
                },
                error: function(e){
                    window.alert("Error Occurred! Please refer to console.");
                    console.log(e.message);
                }
              });
            }
          });
      });
      </script>
</div>
</div>    
</body>
</html>