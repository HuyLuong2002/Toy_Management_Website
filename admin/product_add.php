<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/product_addController.php";
include_once $filepath . "/controller/categoryController.php";
include_once $filepath . "/controller/saleController.php";

$product_addController = new ProductAddController();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $insertProduct = $product_addController->insert_product($_POST, $_FILES);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add.css" />

    <title>Add product</title>
</head>

<body>
    <div class="form-container">

        <form action="product_add.php" method="post" enctype="multipart/form-data">
            <?php if (isset($insertProduct)) {
              echo $insertProduct;
            } ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select category</option>
                    <?php
                    $categoryController = new CategoryController();
                    $show_cat = $categoryController->show_category();
                    if ($show_cat) {
                      $i = 0;
                      while ($result = $show_cat->fetch_assoc()) {
                        $i++; ?>
                    <option value="<?php echo $result[
                      "id"
                    ]; ?>"><?php echo $result["name"]; ?></option>
                    <?php
                      }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="sale">Sale</label>
                <select id="sale" name="sale" required>
                    <option value="">Select sale</option>
                    <?php
                    $saleController = new SaleController();
                    $show_sale = $saleController->show_sale();
                    if ($show_sale) {
                      $i = 0;
                      while ($result = $show_sale->fetch_assoc()) {
                        $i++; ?>
                    <option value="<?php echo $result[
                      "id"
                    ]; ?>"><?php echo $result["name"]; ?></option>
                    <?php
                      }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>

            <div class="form-group">
                <label for="uploadfile">Upload File</label>
                <input type="file" id="uploadfile" name="uploadfile">
            </div>

            <input type="submit" name="submit" Value="Save" />
        </form>
    </div>

</body>

</html>