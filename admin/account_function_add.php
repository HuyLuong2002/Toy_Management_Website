<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/account_functionController.php";
$account_functionController = new AccountFunctionController();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $insertAccountFunction = $account_functionController->insert_account_function($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add.css" />

    <title>Add account function</title>
</head>

<body>
    <div class="form-container">
        <form action="account_function_add.php" method="post">
            <?php
            if(isset($insertAccountFunction))
            {
                echo $insertAccountFunction;
            }
            ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <input type="submit" name="submit" Value="Save" />
        </form>
    </div>

</body>

</html>