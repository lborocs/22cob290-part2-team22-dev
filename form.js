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
    } else{
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
  if (!(email.value.includes('@') || email.value.includes('.') || email.value.length > 5)) {
    document.getElementById('banner').innerHTML = `<div class="alert alert-warning" role="alert">Enter valid email!</div>`;
    return false;
  }
  else {
    document.getElementById('banner').innerHTML = `<div class="alert alert-success" role="alert">Successfully made account</div>`;
    return true;
  }


}