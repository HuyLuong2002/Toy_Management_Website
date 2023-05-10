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
  isset($_POST["confirm-password"]) &&
  isset($_POST["firstname"]) && isset($_POST["lastname"])
) {
  $nome = $_POST["nome"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm-password"];
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $result_account = $accountController->insert_account($nome, md5($password), $firstname, $lastname);
}

if (isset($_GET["action"]) == "logout") {
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
    // if (isset($result_login)) {
    //   echo $result_login;
    // }
    if (isset($result_account)) {
      echo $result_account;
    }
    ?>
    <div class="DarkOverlay"></div>
    <div class="wrap-login-signup">
      <form class="form-sign-in" id="form-login" action="login.php" method="post">
        <h1>Log In</h1>
        <?php
        if (isset($result_login)) {
          echo $result_login;
        }
        ?>
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

      <form action="login.php" method="post" class="form-sign-up hide-form" id="form-signup">
        <h1>Sign Up</h1>
        <div class="form-group">
          <label for="nome">Username:</label>
          <span id="check-username"></span>
          <input placeholder="" type="text" class="infos" id="sign-up-nome" name="nome" onInput="checkUsername();">
          <div id="username_notify" class="username_notify"></div>
        </div>

        <div class="form-group">
          <div class="mario"></div>
          <label for="firstname">Firstname:</label>
          <input type="text" id="firstname" name="firstname" class="firstname">
          <div id="firstname_notify" class="username_notify"></div>
        </div>

        <div class="form-group">
          <div class="mario"></div>
          <label for="lastname">Lastname:</label>
          <input type="text" id="lastname" name="lastname" class="lastname">
          <div id="lastname_notify" class="username_notify"></div>
        </div>

        <div class="form-group">
          <div class="mario"></div>
          <label for="password">Password:</label>
          <input type="password" id="sign-up-password" name="password" placeholder="">
          <div id="password_notify" class="password_notify"></div>
        </div>

        <div class="form-group">
          <div class="mario"></div>
          <label for="confirm">Confirm Password:</label>
          <input type="password" id="confirm-password" name="confirm-password">
          <!-- <div id="confirm_password_notify"></div> -->
        </div>

        <div class="wrap-btn">
          <button type="submit" id="btn-sign-up" onclick="return checkSignUp();">Sign up</button>
          <div>
            <i>Already have an account? <a onclick="handleClick(event, '2');">Log in now</a></i>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="./js/login.js"></script>

  <script>
    let formLogin = document.getElementById("form-login")
    let formSignUp = document.getElementById("form-signup")

    const handleClick = (event, id) => {
      event.preventDefault();
      if (id === "1") {
        formLogin.classList.add("hide-form");
        formSignUp.classList.remove("hide-form");
        formSignUp.classList.add("active");
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
        data: 'nome=' + $("#sign-up-nome").val(),
        type: "POST",
        success: function(data) {
          $("#check-username").html(data);
        },
        error: function() {}
      });
    }
  </script>


  <script src="/js/validate_input.js"></script>
  <script>
    $(document).ready(function() {
      $("#sign-up-password").keyup(function() {
        var input = $(this).val();
        console.log(input);

        if (checkPassword(input) == 0) {
          $("#password_notify").html("<span class='error'>Password not valid</span>");
          $("#password_notify").css("display", "block");
          $("#password_notify").css("margin-bottom", "1rem");
          $("#btn-sign-up").prop("disabled", true);
          $("#btn-sign-up").css("background-color", "#de5959");
        } else if (checkPassword(input) == 1) {
          $("#password_notify").html("<span class='error'>Password  must be between 6 and 20 characters</span>");
          $("#password_notify").css("display", "block");
          $("#password_notify").css("margin-bottom", "1rem");
          $("#btn-sign-up").prop("disabled", true);
          $("#btn-sign-up").css("background-color", "#de5959");
        } else if (checkPassword(input) == 2) {
          $("#password_notify").html("<span class='error'>Password must contain lowercase, uppercase and special characters</span>");
          $("#password_notify").css("display", "block");
          $("#password_notify").css("margin-bottom", "1rem");
          $("#btn-sign-up").prop("disabled", true);
          $("#btn-sign-up").css("background-color", "#de5959");
        } else {
          $("#password_notify").css("display", "none");
          $("#btn-sign-up").prop("disabled", false);
          $("#btn-sign-up").css("background-color", "#0be881");
        }
      });
    });

    $("#sign-up-nome").keyup(function() {
      var input = $(this).val();
      if (checkUsername(input) == false) {
        $("#username_notify").html("<span class='error'>User name Not Valid</span>");
        $("#username_notify").css("display", "block");
        $("#btn-sign-up").prop("disabled", true);
        $("#btn-sign-up").css("background-color", "red");
        // $("#username_notify").css("margin-bottom", "1rem");
      } else {
        $("#username_notify").css("display", "none");
        $("#btn-sign-up").prop("disabled", false);
        $("#btn-sign-up").css("background-color", "#0be881");
      }
    });

    $("#firstname").keyup(function() {
      var input = $(this).val();
      if (checkName(input) == false) {
        $("#firstname_notify").html("<span class='error'>First name Not Valid</span>");
        $("#firstname_notify").css("display", "block");
        $("#btn-sign-up").prop("disabled", true);
        $("#btn-sign-up").css("background-color", "red");
        // $("#firstname_notify").css("margin-bottom", "1rem");
      } else {
        $("#firstname_notify").css("display", "none");
        $("#btn-sign-up").prop("disabled", false);
        $("#btn-sign-up").css("background-color", "#0be881");
      }
    });

    $("#lastname").keyup(function() {
      var input = $(this).val();
      if (checkName(input) == false) {
        $("#lastname_notify").html("<span class='error'>Last name Not Valid</span>");
        $("#lastname_notify").css("display", "block");
        $("#btn-sign-up").prop("disabled", true);
        $("#btn-sign-up").css("background-color", "red");
        // $("#lastname_notify").css("margin-bottom", "1rem");
      } else {
        $("#lastname_notify").css("display", "none");
        $("#btn-sign-up").prop("disabled", false);
        $("#btn-sign-up").css("background-color", "#0be881");
      }
    });
  </script>
</body>

</html>