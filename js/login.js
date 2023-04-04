function checkSignIn() {
  var password = document.getElementById("sign-up-password").value;
  var confirm_password = document.getElementById("confirm-password").value;
  
  if(password != confirm_password)
  {
      alert("Your password and confirm password do not match");
  }
  
}


