<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/order.php";

$db = new DB();
$connect = $db->connect();
$order = new Order($connect);
$order->user_id = isset($_GET["userID"]) ? $_GET["userID"] : die();
$show_order = $order->show_user();
$num = $show_order->rowCount();
if ($num > 0) {
  $order_function_array = [];
  $order_function_array["orders"] = [];

  while ($row = $show_order->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    /*
      extract($row);
      Hàm này sử dụng tên các phần tử trong mảng như tên của các biến 
      và giá trị của các phần tử trong mảng sẽ được gán cho các biến 
      tương ứng.
      */
    $order_item = [
      "id" => $id,
      "order_list" => [
        "quantity" => $quantity,
        "date" => $date,
        "address" => $address,
        "phone" => $phone,
        "email" => $email,
        "country" => $country,
        "total_price" => $total_price,
        "pay_method" => $pay_method,
      ],
    ];

    array_push(
      $order_function_array["orders"],
      $order_item
    );
  }
  echo json_encode($order_function_array);
}
?>
