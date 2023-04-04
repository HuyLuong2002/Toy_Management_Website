<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\Toy_Management_Website\classes\account.php";

$account = new Account();

// if (
//   isset($_POST["nome"]) &&
//   isset($_POST["password"]) &&
//   isset($_POST["confirm_password"])
// ) {
//   $nome = $_POST["nome"];
//   $password = $_POST["password"];
//   $confirm_password = $_POST["confirm_password"];

//   $result_account = $account->insert_account($nome, md5($password));
// }
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
        <div class="DarkOverlay"></div>
        <div class="wrap-login-signup">
            <form class="form" id="form-login">
                <h1>Log In</h1>

                <label for="nome">Username:</label>
                <input type="text" class="infos" id="nome" name="nome">
                <div class="mario"></div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">

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
                    <button type="submit" id="btn-sign-in" onclick="checkSignIn();">Sign up</button>

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