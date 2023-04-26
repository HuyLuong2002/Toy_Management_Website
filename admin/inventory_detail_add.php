<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/inventory_detail_addController.php";
include_once $filepath . "/controller/productsController.php";
include_once $filepath . "/controller/inventoryController.php";
$inventory_detail_addController = new InventoryDetailAddController();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $insertInventoryDetail = $inventory_detail_addController->insert_inventory_detail($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add.css" />

    <title>Add detail receipt</title>
</head>

<body>
    <div class="form-container">
        <form action="inventory_detail_add.php" method="post">
            <?php
                if(isset($insertInventoryDetail))
                {
                    echo (string) $insertInventoryDetail;
                }
            ?>
            <div class="form-group">
                <label for="enter-id">Enter ID</label>
                <select id="enter-id" name="enter-id" required>
                    <option value="">Select enter</option>
                    <?php
                    $inventoryController = new InventoryController();
                    $show_inventory = $inventoryController->show_inventory();
                    if ($show_inventory) {
                      $i = 0;
                      while ($result = $show_inventory->fetch_assoc()) {
                        $i++; ?>
                    <option value="<?php echo $result[
                      "id"
                    ]; ?>"><?php echo $result["id"]; ?></option>
                    <?php
                      }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="product">Product</label>
                <select id="product" name="product" required>
                    <option value="">Select product</option>
                    <?php
                    $productsController = new ProductsController();
                    $show_product = $productsController->show_product();
                    if ($show_product) {
                      $i = 0;
                      while ($result = $show_product->fetch_assoc()) {
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
                <input type="text" id="quantity" name="quantity" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" required>
            </div>




            <input type="submit" name="submit" Value="Save" />
        </form>
    </div>

</body>

</html>