<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/classes/permission.php";
$permission = new Permission();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $insertPermission = $permission->insert_permission($_POST, $_FILES);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add.css" />

    <title>Add permission</title>
</head>

<body>
    <div class="form-container">
        <form action="permission_add.php" method="post" enctype="multipart/form-data">
            <?php
                if(isset($insertPermission))
                {
                    echo $insertPermission;
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