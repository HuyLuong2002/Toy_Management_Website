<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/sale_editController.php";
include_once $filepath . "/helpers/format.php";

$sale_editController = new SaleEditController();
$fm = new Format();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $updateSale = $sale_editController->update_sale($_POST, $id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add.css">
    <title>Edit Sale</title>
</head>

<body>
    <div class="form-container">
        <?php if (isset($_GET["id"])) {
            $show_sale = $sale_editController->get_sale_by_id($_GET["id"]);
            if ($show_sale) {
                $result_sale = $show_sale->fetch_array();
        ?>
                <form action="sale_edit.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
                    <div class="form-notify">
                        <p>
                            <?php if (isset($updateSale)) {
                                echo $updateSale;
                            } ?>
                        </p>
                        <button class="back"><a href="index.php?id=8&page=1">Back</a></button>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required value="<?php echo $result_sale[1]; ?>">
                    </div>

                    <div class="form-group">
                        <label for="start">Start date</label>
                        <input type="date" id="start" name="start" required value="<?php echo $fm->formatDateReverse($result_sale[3]); ?>">
                    </div>

                    <div class="form-group">
                        <label for="end">End date</label>
                        <input type="date" id="end" name="end" required value="<?php echo $fm->formatDateReverse($result_sale[4]); ?>">
                    </div>

                    <div class="form-group">
                        <label for="percent">Percent</label>
                        <input type="number" id="percent" name="percent" required value="<?php echo $result_sale[5]; ?>">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <?php
                            if ($result_sale[6] == 1) {
                                $status_1 = "selected";
                                $status_0 = "";
                            } else {
                                $status_1 = "";
                                $status_0 = "selected";
                            }
                            ?>
                            <option value="">Select status</option>
                            <option value="1" <?php echo $status_1 ?>>Còn áp dụng</option>
                            <option value="0" <?php echo $status_0 ?>>Hết áp dụng</option>
                        </select>
                    </div>

                    <input type="submit" name="submit" Value="Save" />
                </form>
    </div>
<?php
            }
        }
?>
</body>

</html>