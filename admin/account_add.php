<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/accountController.php";
include_once $filepath . "/controller/permissionController.php";
$accountController = new AccountController();
$permissionController = new PermissionController();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $insertAccountAdmin = $accountController->insert_account_admin($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add.css" />

    <title>Add receipt</title>
</head>

<body>
    <div class="form-container">
        <form action="account_add.php" method="post">
            <?php
                if(isset($insertAccountAdmin))
                {
                    echo $insertAccountAdmin;
                }
            ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="firstname">First name</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>

            <div class="form-group">
                <label for="lastname">Last name</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="0">Nam</option>
                    <option value="1">Nữ</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date-of-birth">Date of Birth</label>
                <input type="date" id="dateofbirth" name="dateofbirth" required>
            </div>

            <div class="form-group">
                <label for="place-of-birth">Place of Birth</label>
                <input type="text" id="placeofbirth" name="placeofbirth" required>
            </div>

            <div class="form-group">
                <label for="permission">Permission</label>
                <select id="permission" name="permission" required>
                    <option value="">Select permission</option>
                    <?php
                        $show_permission = $permissionController->show_permission();
                        if($show_permission)
                        {
                            while($result = $show_permission->fetch_assoc())
                            {
                    ?>
                    <option value="<?php echo $result["id"]; ?>"><?php echo $result["name"]?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="">Select status</option>
                    <option value="0">Ngừng hoạt động</option>
                    <option value="1">Đang hoạt động</option>
                </select>
            </div>

            <input type="submit" name="submit" Value="Save" />
        </form>
    </div>

</body>

</html>