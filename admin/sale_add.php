<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/sale_addController.php";
$sale_addController = new SaleAddController();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $insertSale = $sale_addController->insert_sale($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add.css">
    <title>Add Sale</title>
</head>

<body>
    <div class="form-container">
        <form action="sale_add.php" method="post" enctype="multipart/form-data">
            <?php if (isset($insertSale)) {
                echo $insertSale;
            } ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="start">Start date</label>
                <input type="date" id="start" name="start" required>
            </div>

            <div class="form-group">
                <label for="end">End date</label>
                <input type="date" id="end" name="end" required>
            </div>

            <div class="form-group">
                <label for="percent">Percent</label>
                <input type="number" id="percent" name="percent" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="">Select status</option>
                    <option value="1">Còn áp dụng</option>
                    <option value="0">Hết áp dụng</option>
                </select>
            </div>

            <input type="submit" name="submit" Value="Save" />
        </form>
    </div>
</body>

</html>