<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/inventory_addController.php";
include_once $filepath . "/controller/providersController.php";
$inventory_addController = new InventoryAddController();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $insertInventory = $inventory_addController->insert_inventory($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add.css" />

    <title>Add receipt</title>
</head>

<body>
    <div class="form-container">
        <form action="inventory_add.php" method="post">
            <?php
                if(isset($insertInventory))
                {
                    echo $insertInventory;
                }
            ?>
            <div class="form-group">
                <label for="enter-date">Enter Date</label>
                <input type="date" id="enter-date" name="enter-date" required>
            </div>

            <div class="form-group">
                <label for="total-quantity">Total Quantity</label>
                <input type="text" id="total-quantity" name="total-quantity" required>
            </div>

            <div class="form-group">
                <label for="total-price">Total Price</label>
                <input type="text" id="total-price" name="total-price" required>
            </div>

            <div class="form-group">
                <label for="provider">Provider</label>
                <select id="provider" name="provider" required>
                    <option value="">Select provider</option>
                    <?php
                    $providerController = new ProviderController();
                    $show_provider = $providerController->show_provider_user();
                    if ($show_provider) {
                      $i = 0;
                      while ($result = $show_provider->fetch_assoc()) {
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
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="">Select status</option>
                    <option value="1">Đang giao</option>
                    <option value="0">Đã giao</option>
                </select>
            </div>

            <input type="submit" name="submit" Value="Save" />
        </form>
    </div>

</body>

</html>