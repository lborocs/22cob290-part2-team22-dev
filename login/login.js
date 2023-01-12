$(document).ready(function () {

    $("#forgotForm").submit(function(event){
      event.preventDefault();
      
      var email = $("#emailInput").val();

      $.ajax({
        url:"emailFinder.php",
        type:"POST",
        data: {emailInput: email},
        success: function(responseData){
          console.log(responseData);
          if (responseData === "true"){
            $( "#emailInput" ).prop( "disabled", true );
            $(".btn").css("display","None");
            document.getElementById('banner').innerHTML = `<div class="alert alert-success" role="alert">An email has been sent to you!</div>`;

            
          } else {
            window.alert("Invalid email try again");
          }
        },
        error: function(e){
            window.alert("Error Occurred! Please refer to console.");
            console.log(e.message);
        }
      });
    });

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


      let timeout;
      const password = document.getElementById('passwordInput');
      const strengthBadge = document.getElementById('StrengthDisp');
      const strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})')
      const mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))')
      
      
      function StrengthChecker(PasswordParameter){
        if(strongPassword.test(PasswordParameter)) {
            strengthBadge.style.backgroundColor = "green";
            strengthBadge.textContent = 'Strong';
        } else if(mediumPassword.test(PasswordParameter)){
            strengthBadge.style.backgroundColor = 'blue';
            strengthBadge.textContent = 'Medium';
        } else{
            strengthBadge.style.backgroundColor = 'red';
            strengthBadge.textContent = 'Weak';
        }
      }
      password.addEventListener("input", () => {
      
        strengthBadge.style.display= 'block';
        clearTimeout(timeout);
      
        timeout = setTimeout(() => StrengthChecker(password.value), 500);
      
        if(password.value.length !== 0){
            strengthBadge.style.display != 'block';
        } 
        else{
            strengthBadge.style.display = 'none';
        }
      });
      
      function validateForm() {
        const strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})');
        const email = document.getElementById('emailInput');
        const passwordInput = document.getElementById('passwordInput');
        const passwordMatchInput = document.getElementById('passwordMatchInput');
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
      
});




