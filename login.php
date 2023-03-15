<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <title>Sign In & Sign up Form</title>
    <link rel="stylesheet" href="./assets/css/login.css">
</head>

<body>

    <div class="wrapper-form">
        <div class="DarkOverlay"></div>
        <form class="form">
            <h1>Log In</h1>

            <label for="nome">UserName:</label>
            <input type="text" class="infos" id="nome" name="nome">
            <div class="mario"></div>
            <label for="email">Password:</label>
            <input type="email" id="email" name="email">

            <div class="wrap-btn">
                <button type="submit">LogIn</button>

                <div>
                    <i>don't have an account?</i>
                    <button type="reset" id="limpar">SignUp</button>
                </div>
            </div>
        </form>

        <form class="form">
            <h1>Sign Up</h1>

            <label for="nome">UserName:</label>
            <input type="text" class="infos" id="nome" name="nome">
            <div class="mario"></div>
            <label for="email">Password:</label>
            <input type="email" id="email" name="email">

            <div class="mario"></div>
            <label for="confirm">Confirm Password:</label>
            <input type="email" id="email" name="email">

            <div class="wrap-btn">
                <button type="submit">LogIn</button>

                <div>
                    <i>don't have an account?</i>
                    <button type="reset" id="limpar">SignUp</button>
                </div>
            </div>
        </form>
    </div>

    <script src="./js/login.js"></script>
</body>

</html>