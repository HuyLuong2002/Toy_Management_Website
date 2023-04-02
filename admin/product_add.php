<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/classes/product.php";
include_once $filepath . "/classes/category.php";
include_once $filepath . "/classes/sale.php";
$product = new Product();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $insertProduct = $product->insert_product($_POST, $_FILES);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/newProduct.css" />

    <title>Add product</title>
</head>

<body>
    <div class="form-container">
        <?php if (isset($insertProduct)) {
          echo $insertProduct;
        } ?>
        <form action="product_add.php" method="post" enctype="multipart/form-data">
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
                    $cat = new Category();
                    $show_cat = $cat->show_category();
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
                    $sale = new Sale();
                    $show_sale = $sale->show_sale();
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