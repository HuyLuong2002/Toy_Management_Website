<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/inventory_editController.php";
include_once $filepath . "/controller/providersController.php";
$inventory_editController = new InventoryEditController();
$fm = new Format();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $updateInventory = $inventory_editController->update_inventory($_POST, $id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add.css" />

    <title>Edit receipt</title>
</head>

<body>
    <div class="form-container">
        <?php if (isset($_GET["id"])) {
            $show_inventory = $inventory_editController->get_inventory_by_id($_GET["id"]);
            if ($show_inventory) {
                $result_inventory = $show_inventory->fetch_assoc();
        ?>
                <form action="inventory_edit.php?id=<?php echo $result_inventory["id"]; ?>" method="post">
                    <?php
                    if (isset($updateInventory)) {
                        echo (string) $updateInventory;
                    }
                    ?>
                    <div class="form-group">
                        <label for="enter-date">Enter Date</label>
                        <input type="date" id="enter-date" name="enter-date" value="<?php echo $fm->formatDateReverse($result_inventory["enter_date"]) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="total-quantity">Total Quantity</label>
                        <input type="text" id="total-quantity" name="total-quantity" value="<?php echo $result_inventory["total_quantity"]; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="total-price">Total Price</label>
                        <input type="text" id="total-price" name="total-price" value="<?php echo $result_inventory["total_price"]; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="provider">Provider</label>
                        <select id="provider" name="provider" required>
                            <option value="">Select provider</option>
                            <?php
                            $providerController = new ProviderController();
                            $show_provider = $providerController->show_provider_user();
                            if ($show_provider) {
                                while ($result = $show_provider->fetch_assoc()) {
                                    if ($result["id"] == $result_inventory["provider_id"]) {
                            ?>
                                        <option value="<?php echo $result["id"]; ?>" <?php echo "selected" ?>><?php echo $result["name"]; ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo $result["id"]; ?>"><?php echo $result["name"]; ?></option>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <?php
                            if ($result_account["status"] == 1) {
                                $status_1 = "selected";
                                $status_0 = "";
                            } else {
                                $status_1 = "";
                                $status_0 = "selected";
                            }
                            ?>
                            <option value="">Select status</option>
                            <option value="1" <?php echo $status_1 ?>>Đang giao</option>
                            <option value="0" <?php echo $status_0 ?>>Đã giao</option>
                        </select>
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