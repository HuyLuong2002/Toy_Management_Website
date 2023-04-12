<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\classes\detail_order.php";
include_once $filepath . "\orders.php";
if (isset($_GET["deleteid"])) {
  $orderDetail = new DetailOrder();
  $delete_id = $_GET["deleteid"];
  $delete_orders = $orderDetail->delete_detail_orders($delete_id);
  
  $orders = new Orders();
  $delete_id = $_GET["id"];
  $delete_orders = $orders->delete_orders($delete_id);
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