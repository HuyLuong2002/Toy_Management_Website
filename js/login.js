function checkSignIn() {
  var nome = document.getElementById("sign-in-nome").value;
  var password = document.getElementById("sign-in-password").value;
  var confirm_password = document.getElementById("confirm_password").value;
  
  if(password != confirm_password)
  {
      alert("Your password and confirm password do not match");
  }
  
}
