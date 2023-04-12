<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/detail_orders.php";

$db = new DB();
$connect = $db->connect();
$detail_order_product = new DetailOrders($connect);
$read = $detail_order_product->read();

$num = $read->rowCount();
if ($num > 0) {
  $detail_order_product_array = [];
  $detail_order_product_array["detail_order_product"] = [];

  while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    /*
    extract($row);
    Hàm này sử dụng tên các phần tử trong mảng như tên của các biến 
    và giá trị của các phần tử trong mảng sẽ được gán cho các biến 
    tương ứng.
    */
    $detail_order_product_item = [
      "id" => $id,
      "order_id" => $order_id,
      "product_list" => [
        "product_id" => $product_id,
        "quantity" => $quantity,
        "price" => $price,
      ],
    ];
  
    array_push(
      $detail_order_product_array["detail_order_product"],
      $detail_order_product_item
    );
  }
  echo json_encode($detail_order_product_array);
}

?>
