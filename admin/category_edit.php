<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/category_editController.php";
$category_editController = new CategoryEditController();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $updatecategory = $category_editController->update_category($_POST, $_FILES, $id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/newProduct.css" />

    <title>Edit category</title>
</head>

<body>
    <div class="form-container">
        <?php if (isset($updatecategory)) {
            echo $updatecategory;
        } ?>
        <?php if (isset($_GET["id"])) {
            $show_category = $category_editController->show_category_by_id($_GET["id"]);
            if ($show_category) {
                $result_category = $show_category->fetch_array();
                ?>

                <form action="category_edit.php?id=<?php echo $result_category[0]; ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo $result_category[1]; ?>" required>
                    </div>
                    <input type="submit" name="submit" Value="Update" />
                </form>
                <?php
            }
        } ?>
    </div>


</body>

</html>