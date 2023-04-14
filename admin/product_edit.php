<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/product_editController.php";
include_once $filepath . "/controller/saleController.php";
include_once $filepath . "/controller/categoryController.php";
$product_editController = new ProductEditController();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $updateProduct = $product_editController->update_product($_POST, $_FILES, $id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add.css" />

    <title>Edit product</title>
</head>

<body>
    <div class="form-container">
        <?php if (isset($_GET["id"])) {
            $show_product = $product_editController->get_product_by_id($_GET["id"]);
            if ($show_product) {
                $result_product = $show_product->fetch_array();
                ?>

                <form action="product_edit.php?id=<?php echo $result_product[0]; ?>" method="post"
                    enctype="multipart/form-data">
                    <?php if (isset($updateProduct)) {
                        echo $updateProduct;
                    } ?>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo $result_product[1]; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price" value="<?php echo $result_product[3]; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" required><?php echo $result_product[4]; ?></textarea>
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
                        <input type="number" id="quantity" name="quantity" value="<?php echo $result_product[10]; ?>" required>
                    </div>

                    <div class="form-group">
                        <div style="display:flex; justify-content:center;">
                            <img src="<?php echo "uploads/" .
                                $result_product[2]; ?>" alt="" style="width:25%;height:25%;">
                        </div>
                        <label for="uploadfile">Upload File</label>
                        <input type="file" id="uploadfile" name="uploadfile">
                    </div>

                    <input type="submit" name="submit" Value="Update" />
                </form>
                <?php
            }
        } ?>
    </div>


</body>

</html>