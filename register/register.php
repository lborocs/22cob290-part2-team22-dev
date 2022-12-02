<?php
session_start();

function checkInviteCode($inviteCode){
  $servername = "sci-project";
  $username = "colmt";
  $password = "Gn63O4FwYP";
  $dbname = "colmt";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT * FROM invites WHERE inviteCode = '$inviteCode'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $record;
  } else {
    return "false";
  }
}

if(isset($_GET['inviteCode'])){
  $record = checkInviteCode($_GET['inviteCode']);
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
    <body style="width:100% !important;">
    <title>User Registration Page</title>
</head>
<body>
<div class="container-fluid login-container">

    <h3 class="center title">Register as User</h3>
    <div class="jumbotron form-jumbo">
      <div id = 'banner'></div>
        <form name = 'Register-Form' onsubmit="return validateForm()" action = 'registerProcess.php' id = "form2" method = 'POST'>
            <div class="form-group">
              <label for="emailInput">Email Address</label>
              <input type="email" class="form-control" id="emailInput" name = "emailInput"  value="<?php echo $record['inviteeEmail']?>" readonly>
              <span class="error" aria-live="polite"></span>
            </div>
            <div class="form-group">
                <div class="group">
              <label class="pass" for="passInp">Password</label>
            </div>
              
              <input type="password" class="form-control" id="passwordInput" name = "passwordInput">
            
              <br>
              <span id="StrengthDisp" class="badge displayBadge"></span>
              <script src="register.js"></script> 
            </div>

            <div class="form-group">
                <div class="group">
              <label class="pass" for="passwordMatchInput">Confirm Password</label>
            </div>
            <input type="password" class="form-control" id="passwordMatchInput">
            </div>
            <div class="form-group">
              <label for="inviteCode">Invite Code:</label>
              <input type="email" class="form-control" id="inviteCode" name = "inviteCode"  value="<?php echo $record['inviteCode']?>" readonly>
              <span class="error" aria-live="polite"></span>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
    </div>
</div>
</div>
    
    
</body>
</html>
<?php
}else{
  header("Location: /login/index.php");
  die();
}
?>