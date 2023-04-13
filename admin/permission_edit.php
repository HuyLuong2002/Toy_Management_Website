<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/classes/permission.php";

$permission = new Permission();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $updatePermission = $permission->update_permission($_POST, $id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add.css" />

    <title>Edit permission</title>
</head>

<body>
    <div class="form-container">
        <?php if (isset($_GET["id"])) {
            $show_permission = $permission->get_permission_by_id($_GET["id"]);
            if ($show_permission) {
                $result_permission = $show_permission->fetch_array();
                ?>

                <form action="permission_edit.php?id=<?php echo $result_permission["id"]; ?>" method="post"
                    enctype="multipart/form-data">
                    <?php if (isset($updatePermission)) {
                        echo $updatePermission;
                    } ?>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo $result_permission["name"]; ?>" required>
                    </div>

                    <input type="submit" name="submit" Value="Update" />
                </form>
                <?php
            }
        } ?>
    </div>


</body>

</html>