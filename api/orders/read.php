<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/order.php";

$db = new DB();
$connect = $db->connect();
$order = new Order($connect);
$read = $order->read();

$num = $read->rowCount();
if ($num > 0) {
  $order_array = [];
  $order_array["order"] = [];

  while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    /*
    extract($row);
    Hàm này sử dụng tên các phần tử trong mảng như tên của các biến 
    và giá trị của các phần tử trong mảng sẽ được gán cho các biến 
    tương ứng.
    */
    $order_item = [
      "id" => $id,
      "user_id" => $user_id,
      "quantity" => $quantity,
      "date" => $date,
      "total_price" => $total_price,
      "pay_method" => $pay_method,
    ];
    //đẩy dữ liệu của mảng question_item vào mảng mới là category_array['data]
    array_push($order_array["order"], $order_item);
  }
  echo json_encode($order_array);
}

?>
