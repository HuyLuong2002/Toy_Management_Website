<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/order.php";

$db = new DB();
$connect = $db->connect();
$order = new Order($connect);
$order->id = isset($_GET["id"]) ? $_GET["id"] : die();
$order->show($order->id);
$order_item = [
  "id" => $order->id,
  "user_id" => $order->user_id,
  "quantity" => $order->quantity,
  "date" => $order->date,
  "total_price" => $order->total_price,
  "pay_method" => $order->pay_method,
];
print_r(json_encode($order_item));

?>
