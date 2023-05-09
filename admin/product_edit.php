<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/productsController.php";
include_once $filepath . "/controller/saleController.php";
include_once $filepath . "/controller/categoryController.php";
$product_editController = new ProductsController();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $updateProduct = $product_editController->update_product($_POST, $id);
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
        <div class="back">
            <a href="index.php?id=2&page=1">Back</a>
        </div>
        <?php if (isset($_GET["id"])) {
            $show_product = $product_editController->get_product_by_id($_GET["id"]);
            if ($show_product) {
                $result_product = $show_product->fetch_array();
        ?>

                <form action="product_edit.php?id=<?php echo $result_product[0]; ?>" method="post" enctype="multipart/form-data">
                    <div class="notification-product">
                        <?php if (isset($updateProduct)) {
                            echo $updateProduct;
                        } ?>
                    </div>

                    <div class="form-left-info">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="name" value="<?php echo $result_product[1]; ?>">
                            <div id="name_add_result"></div>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" id="price" name="price" class="price" value="<?php echo $result_product[3]; ?>" required>
                            <div id="price_add_result"></div>
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" name="category" class="category" required>
                                <option value="">Select category</option>
                                <?php
                                $categoryController = new CategoryController();
                                $show_cat = $categoryController->show_category();
                                if ($show_cat) {
                                    $i = 0;
                                    while ($result = $show_cat->fetch_assoc()) {
                                        if ($result_product[7] == $result["id"]) {
                                            $select_category = "selected";
                                        } else {
                                            $select_category = "";
                                        }
                                        $i++; ?>
                                        <option value="<?php echo $result["id"]; ?>" <?php echo $select_category ?>><?php echo $result["name"]; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sale">Sale</label>
                            <select id="sale" name="sale" class="sale" required>
                                <option value="">Select sale</option>
                                <?php
                                $saleController = new SaleController();
                                $show_sale = $saleController->show_sale();
                                if ($show_sale) {
                                    $i = 0;
                                    while ($result = $show_sale->fetch_assoc()) {
                                        if ($result_product[8] == $result["id"]) {
                                            $select_sale = "selected";
                                        } else {
                                            $select_sale = "";
                                        }
                                        $i++; ?>
                                        <option value="<?php echo $result["id"]; ?>" <?php echo $select_sale ?>><?php echo $result["name"]; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" id="quantity" name="quantity" class="quantity" value="<?php echo $result_product[10]; ?>" required>
                            <div id="quantity_add_result"></div>
                        </div>

                        <div class="form-group image">
                            <div class="image-product">
                                <img src="<?php echo "uploads/" . $result_product[2]; ?>" alt="">
                            </div>
                            <div class="image-product-btn">
                                <label for="uploadfile">Upload File</label>
                                <input type="file" id="uploadfile" name="uploadfile" class="uploadfile" required>
                            </div>
                        </div>

                        <input type="submit" name="submit" id="add-btn" class="submit" Value="Update" />

                    </div>

                    <div class="form-right-info">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="tinymce"><?php echo $result_product[4]; ?></textarea>
                        </div>
                    </div>

                </form>
        <?php
            }
        } ?>
    </div>

</body>
<script src="https://cdn.tiny.cloud/1/a4yip95kil5x5nn5y60qcu7jeg755ii26thhre1j0rxwg6ae/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '.tinymce',

        width: "100%",
        height: "480",
    });
</script>

</html>