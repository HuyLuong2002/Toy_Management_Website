<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/account_functionController.php";
include_once $filepath . "/controller/permissionController.php";
$account_functionController = new AccountFunctionController();
$fm = new Format();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $updateAccountFunction = $account_functionController->update_account_function($_POST, $id);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add.css" />
    <title>Edit account function</title>
</head>

<body>
    <div class="form-container">
    <?php if (isset($_GET["id"])) {
            $show_account_function = $account_functionController->show_account_function_by_id($_GET["id"]);
            if ($show_account_function) {
                $result_account_function = $show_account_function->fetch_assoc();
                ?>
        <form action="account_function_edit.php?id=<?php echo $result_account_function["id"]; ?>" method="post">
            <?php
                if(isset($updateAccountFunction))
                {
                    echo $updateAccountFunction;
                }
            ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required value="<?php echo $result_account_function["name"];?>">
            </div>

            <input type="submit" name="submit" Value="Save" />
        </form>
        <?php
            }
        }
        ?>
    </div>

</body>

</html>