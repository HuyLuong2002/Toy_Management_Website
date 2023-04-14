<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath .
  "\Toy_Management_Website\controller\accountController.php";
include_once $filepath . "\lib\session.php";

$accountController = new AccountController();
if (isset($_POST["sign-in-nome"]) && isset($_POST["sign-in-password"])) {
  $result_login = $accountController->login(
    $_POST["sign-in-nome"],
    $_POST["sign-in-password"]
  );
}
if (
  isset($_POST["nome"]) &&
  isset($_POST["password"]) &&
  isset($_POST["confirm-password"])
) {
  $nome = $_POST["nome"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm-password"];

  $result_account = $accountController->insert_account($nome, md5($password));
}

if(isset($_GET["action"]) == "logout")
{
  Session::init();
  Session::destroy();
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
    <link rel="stylesheet" href="./assets/css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>

    <div class="wrapper-form">
      <?php
        if(isset($result_login))
        {
          echo $result_login;
        }
        if(isset($result_account))
        {
          echo $result_account;
        }
      ?>
        <div class="DarkOverlay"></div>
        <div class="wrap-login-signup">
            <form class="form" id="form-login" action="login.php" method="post">
                <h1>Log In</h1>

                <label for="nome">Username:</label>
                <input type="text" class="infos" id="nome" name="sign-in-nome">
                <div class="mario"></div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="sign-in-password">

                <div class="wrap-btn">
                    <button type="submit">Log in</button>

                    <div>
                        <i>Don't have an account? <a onclick="handleClick(event, '1')">Sign up now</a></i>

                    </div>
                </div>
            </form>

            <form action="login.php" method="post" class="form hide-form" id="form-signup">
                
                <h1>Sign Up</h1>
                <label for="nome">Username:</label>
                <span id="check-username"></span>
                <input type="text" class="infos" id="sign-up-nome" name="nome" onInput="checkUsername();">
                <div class="mario"></div>
                <label for="password">Password:</label>
                <input type="password" id="sign-up-password" name="password">

                <div class="mario"></div>
                <label for="confirm">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password">
                <div class="wrap-btn">
                    <button type="submit" id="btn-sign-up" onclick="checkSignUp();">Sign up</button>

                    <div>
                        <i>Already have an account? <a onclick="handleClick(event, '2');">Log in now</a></i>
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

    <script>
        function checkUsername() {
            jQuery.ajax({
                url: "check_login.php",
                data: 'nome='+$("#sign-up-nome").val(),
                type: "POST",
                success: function(data) {
                $("#check-username").html(data);
                },
                error:function () {}
            });
        }
    </script>
    

    <script src="./js/login.js"></script>
</body>

</html>