<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/inventory_detail_editController.php";
include_once $filepath . "/controller/productsController.php";
include_once $filepath . "/controller/inventoryController.php";
$inventory_detail_editController = new InventoryDetailEditController();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $updateInventoryDetail = $inventory_detail_editController->update_inventory_detail($_POST, $id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add.css" />

    <title>Edit detail receipt</title>
</head>

<body>
    <div class="form-container">
    <?php if (isset($_GET["id"])) {
            $show_inventory_detail = $inventory_detail_editController->get_detail_enter_by_id($_GET["id"]);
            if ($show_inventory_detail) {
                $result_inventory_detail = $show_inventory_detail->fetch_assoc();
                ?>
        <form action="inventory_detail_edit.php?id=<?php echo $result_inventory_detail["id"]; ?>" method="post">
            <?php
                if(isset($updateInventoryDetail))
                {
                    echo $updateInventoryDetail;
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
                <input type="text" id="quantity" name="quantity" value="<?php echo $result_inventory_detail["quantity"]; ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" value="<?php echo $result_inventory_detail["price"]; ?>" required>
            </div>




            <input type="submit" name="submit" Value="Save" />
        </form>
        <?php
            }
        }
        ?>
    </div>

</body>

</html>