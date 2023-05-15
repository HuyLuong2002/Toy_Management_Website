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

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-sign-up"])){
  $insertAccount = $accountController->insert_account_user($_POST);
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <title>Sign In & Sign up Form</title>
  <link rel="stylesheet" href="./assets/css/login.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>

  <div class="wrapper-form">
    <?php

    if (isset($insertAccount)) {
      echo $insertAccount;
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
        <h2>Sign Up</h2>
        <div class="form-group">
          <label for="nome">Username:</label>
          <span id="check-username"></span>
          <input type="text" class="username" id="sign-up-nome" name="nome" onInput="checkUsername();">
          <div id="username_notify" class="username_notify"></div>
        </div>

        <div class="form-group">
          <label for="firstname">Firstname:</label>
          <input type="text" id="firstname" name="firstname" class="firstname" placeholder="No numbers included">
          <div id="firstname_notify" class="username_notify"></div>
        </div>

        <div class="form-group">
          <label for="lastname">Lastname:</label>
          <input type="text" id="lastname" name="lastname" class="lastname" placeholder="No numbers included">
          <div id="lastname_notify" class="username_notify"></div>
        </div>

        <div class="form-group">
          <label for="gender">Gender</label>
          <select class="gender" id="gender" name="gender" required>
            <option value="">Select gender</option>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
          </select>
        </div>

        <div class="form-group">
          <label for="place_of_birth">Place of birth:</label>
          <input type="text" id="place_of_birth" name="place_of_birth" placeholder="Example: HCM">
          <div id="place_of_birth_notify" class="username_notify"></div>
        </div>

        <div class="form-group">
          <label for="date_birth">Date birth:</label>
          <input type="date" id="date_birth" name="date_birth">
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <div class="form-group-password">
            <input type="password" id="sign-up-password" class="password" name="password" placeholder="Example: Abc@123">
            <span id="showpass"><i class="fa-solid fa-eye" onclick="togglePassword()"></i></span>
          </div>
          <div id="password_notify" class="password_notify"></div>
        </div>

        <div class="form-group">
          <label for="confirm">Confirm Password:</label>
          <input type="password" id="confirm-password" name="confirm-password">
        </div>

        <div class="wrap-btn sign-up">
          <button name="submit-sign-up" type="submit" id="btn-sign-up" onclick="return checkSignUp();">Sign up</button>
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


    const passwordInput = document.getElementById("sign-up-password");
    const showpass = document.getElementById("showpass");

    function togglePassword() {
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordInput.style.fontSize = "16px";
      } else {
        passwordInput.type = "password";
      }
    }

    function handleShowPassClick() {
      if (showpass.style.top === "10px") {
        showpass.style.top = "5px";
      } else {
        showpass.style.top = "10px";
      }
    }

    function handleClickOutside(event) {
      if(!event.target.matches('#sign-up-password', '#showpass')){
        showpass.style.top = "5px";
      }
    }

    passwordInput.addEventListener("click", handleShowPassClick);
    document.addEventListener("click", handleClickOutside);
  </script>

  <script>
    $(document).ready(function() {
      $("#sign-up-nome").keyup(function() {
        $.ajax({
          url: "check_login.php",
          data: 'nome=' + $("#sign-up-nome").val(),
          type: "POST",
          success: function(data) {
            if (data == 1) {
              $("#username_notify").html("<span class='success'>Username is valid</span>");
              $("#btn-sign-up").prop("disabled", false);
              $("#btn-sign-up").css("background-color", "#0be881");
            } else {
              $("#username_notify").html("<span class='error'>Username is used</span>");
              $("#btn-sign-up").prop("disabled", true);
              $("#btn-sign-up").css("background-color", "#de5959");
            }
          },
          error: function() {}
        });
      });
    });
  </script>


  <script src="/js/validate_input.js"></script>
  <script>
    $(document).ready(function() {
      $("#sign-up-password").keyup(function() {
        var input = $(this).val();

        if (checkPassword(input) == 0) {
          $("#password_notify").html("<span class='error'>Password not valid</span>");
          $("#password_notify").css("display", "block");
          // $("#password_notify").css("margin-bottom", "1rem");
          $("#btn-sign-up").prop("disabled", true);
          $("#btn-sign-up").css("background-color", "#de5959");
        } else if (checkPassword(input) == 1) {
          $("#password_notify").html("<span class='error'>Password  must be between 6 and 20 characters</span>");
          $("#password_notify").css("display", "block");
          // $("#password_notify").css("margin-bottom", "1rem");
          $("#btn-sign-up").prop("disabled", true);
          $("#btn-sign-up").css("background-color", "#de5959");
        } else if (checkPassword(input) == 2) {
          $("#password_notify").html("<span class='error'>Password must contain lowercase, uppercase and special characters</span>");
          $("#password_notify").css("display", "block");
          $("#password_notify").css("margin-bottom", "0.5rem");
          $("#btn-sign-up").prop("disabled", true);
          $("#btn-sign-up").css("background-color", "#de5959");
        } else {
          $("#password_notify").css("display", "none");
          $("#btn-sign-up").prop("disabled", false);
          $("#btn-sign-up").css("background-color", "#0be881");
        }
      });
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

    $("#place_of_birth").keyup(function() {
      var input = $(this).val();
      if (checkName(input) == false) {
        $("#place_of_birth_notify").html("<span class='error'>Last name Not Valid</span>");
        $("#place_of_birth_notify").css("display", "block");
        $("#btn-sign-up").prop("disabled", true);
        $("#btn-sign-up").css("background-color", "red");
        // $("#place_of_birth_notify").css("margin-bottom", "1rem");
      } else {
        $("#place_of_birth_notify").css("display", "none");
        $("#btn-sign-up").prop("disabled", false);
        $("#btn-sign-up").css("background-color", "#0be881");
      }
    });
  </script>
</body>

</html>