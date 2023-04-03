<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/order.php";

$db = new DB();
$connect = $db->connect();

$order = new Order($connect);

$data = json_decode(file_get_contents("php://input"));

$order->user_id = $data->user_id;
$order->quantity = $data->quantity;
$order->date = $data->date;
$order->total_price = $data->total_price;
$order->pay_method = $data->pay_method;


if($order->create())
{
    echo json_encode(array('message','Order Created'));
}
else {
    echo json_encode(array('message','Order Not Created'));
}
?>
