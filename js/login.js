function checkSignUp() {
  var password = document.getElementById("sign-up-password").value;
  var confirm_password = document.getElementById("confirm-password").value;
  console.log(password);
  console.log(confirm_password);
  
  if(password !== confirm_password)
  {
      alert("Your password and confirm password do not match");
      console.log(password);
      console.log(confirm_password);
      return false;
  }
  
  return true;
}


