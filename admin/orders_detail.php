<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\controller\detail_orderController.php";
include_once $filepath . "\controller\ordersController.php";

if (isset($_GET["deleteid"])) {
  $order_detailController = new DetailOrderController();
  $delete_id = $_GET["deleteid"];
  $delete_orders = $order_detailController->delete_detail_orders($delete_id);
  
  $ordersController = new OrderController();
  $delete_id = $_GET["id"];
  $delete_orders = $ordersController->delete_orders($delete_id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Details</title>
    <link rel="stylesheet" href="./css/orderDetail.css">
</head>

<body>
    <div class="orders-details" id="orders-details">

    </div>
    <script src="./js/fetch_orders.js"></script>
</body>

</html>