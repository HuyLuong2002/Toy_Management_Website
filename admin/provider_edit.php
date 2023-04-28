<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/provider_editController.php";
$provider_editController = new ProviderEditController();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $updateprovider = $provider_editController->update_provider($_POST, $_FILES, $id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/newProduct.css" />
    <link rel="stylesheet" href="./css/add.css">
    <title>Edit provider</title>
</head>

<body>
    <div class="form-container">
        <?php if (isset($updateprovider)) {
            echo $updateprovider;
        } ?>
        <?php if (isset($_GET["id"])) {
            $show_provider = $provider_editController->get_provider_by_id($_GET["id"]);
            if ($show_provider) {
                $result_provider = $show_provider->fetch_array();
                ?>

                <form action="provider_edit.php?id=<?php echo $result_provider[0]; ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo $result_provider[1]; ?>" required>
                    </div>
                    <input type="submit" name="submit" Value="Update" />
                </form>
                <?php
            }
        } ?>
    </div>


</body>

</html>