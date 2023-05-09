<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/detail_orders.php";

$db = new DB();
$connect = $db->connect();
$detail_order = new DetailOrders($connect);
$detail_order->order_id = isset($_GET["orderID"]) ? $_GET["orderID"] : die();
$show_detail_order = $detail_order->show_detail_order();
$num = $show_detail_order->rowCount();
if ($num > 0) {
  $detail_order_function_array = [];
  $detail_order_function_array["detail_orders"] = [];

  while ($row = $show_detail_order->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    /*
      extract($row);
      Hàm này sử dụng tên các phần tử trong mảng như tên của các biến 
      và giá trị của các phần tử trong mảng sẽ được gán cho các biến 
      tương ứng.
      */
    $detail_order_item = [
      "id" => $id,
      "detail_order_list" => [
        "order_id" => $order_id,
        "product_id" => $product_id,
        "name" => $name,
        "image" => $image,
        "quantity" => $quantity,
        "price" => $price,
      ],
    ];

    array_push(
      $detail_order_function_array["detail_orders"],
      $detail_order_item
    );
  }
  echo json_encode($detail_order_function_array);
}
?>
