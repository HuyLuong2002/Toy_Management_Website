<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/classes/product.php";
include_once $filepath . "/classes/category.php";
include_once $filepath . "/classes/sale.php";
$product = new Product();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $updateProduct = $product->update_product($_POST, $_FILES, $id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/newProduct.css" />

    <title>Edit product</title>
</head>

<body>
    <div class="form-container">
        <?php if (isset($updateProduct)) {
            echo $updateProduct;
        } ?>
        <?php if (isset($_GET["id"])) {
            $show_product = $product->get_product_by_id($_GET["id"]);
            if ($show_product) {
                $result_product = $show_product->fetch_array();
                ?>

                <form action="product_edit.php?id=<?php echo $result_product[0]; ?>" method="post"
                    enctype="multipart/form-data">
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