<?php
include_once "..\classes\adminlogin.php";

$class = new AdminLogin();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $adminUser = $_POST["username"];
  $adminPass = md5($_POST["password"]);

  $login_check = $class ->login_admin($adminUser, $adminPass);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <title>Sign In & Sign up Form</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>

    <div class="wrapper-form">
        <div class="DarkOverlay"></div>
        <div class="wrap-login-signup">
            <form class="form" id="form-login" method="post">
                <h1>Log In</h1>
                <span>
				<?php if (isset($login_check)) {
      echo $login_check;
    } ?>
                </span>

                <label for="nome">Username:</label>
                <input type="text" class="infos" id="username" name="username">
                <div class="mario"></div>
                <label for="email">Password:</label>
                <input type="password" id="password" name="password">

                <div class="wrap-btn">
                    <button type="submit">LogIn</button>

                    <div>
                        <i>Don't have an account? <a onclick="handleClick(event, '1')">Sign up now</a></i>

                    </div>
                </div>
            </form>

            <form class="form hide-form" id="form-signup">
                <h1>Sign Up</h1>

                <label for="nome">UserName:</label>
                <input type="text" class="infos" id="nome" name="nome">
                <div class="mario"></div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">

                <div class="mario"></div>
                <label for="confirm">Confirm Password:</label>
                <input type="password" id="password" name="password">
                <div class="wrap-btn">
                    <button type="submit">SignUp</button>

                    <div>
                        <i>Already have an account? <a onclick="handleClick(event, '2')">Log in now</a></i>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let formLogin = document.getElementById("form-login")
        let formSignUp = document.getElementById("form-signup")

        const handleClick = (event, id) => {
            event.preventDefault();
            if(id === "1") {
                formLogin.classList.add("hide-form");
                formSignUp.classList.remove("hide-form");
            } else {
                formLogin.classList.remove("hide-form");
                formSignUp.classList.add("hide-form");
            }
        }
    </script>
</body>

</html>