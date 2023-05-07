<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\controller\Category_addController.php";
$category_addController = new CategoryAddController();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $insertCategory = $category_addController->insert_Category($_POST, $_FILES);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/table-list.css" />
    <link rel="stylesheet" href="./css/add.css" />
    <title>Add Category</title>

</head>

<body>
    <div class="form-container">
        <?php if (isset($insertCategory)) {
            echo $insertCategory;
        } ?>
        <form action="category_add.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <input type="submit" name="submit" Value="Save" />
        </form>
    </div>
</body>

</html>