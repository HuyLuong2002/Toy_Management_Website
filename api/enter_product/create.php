<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/enter_product.php";

$db = new DB();
$connect = $db->connect();

$enter_product = new EnterProduct($connect);

$data = json_decode(file_get_contents("php://input"));

$enter_product->enter_date = $data->enter_date;
$enter_product->total_quantity = $data->total_quantity;
$enter_product->total_price = $data->total_price;
$enter_product->provider_id = $data->provider_id;
$enter_product->user_id = $data->user_id;
$enter_product->status = $data->status;
$enter_product->create_date = (string) date("d/m/Y");

if($enter_product->create())
{
    echo json_encode(array('message','Enter Product Created'));
}
else {
    echo json_encode(array('message','Enter Product Not Created'));
}
?>
