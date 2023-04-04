<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/enter_product.php";

$db = new DB();
$connect = $db->connect();
$enter_product = new EnterProduct($connect);
$enter_product->id = isset($_GET["id"]) ? $_GET["id"] : die();
$enter_product->show($enter_product->id);
$enter_product_item = [
  "id" => $enter_product->id,
  "enter_date" => $enter_product->enter_date,
  "total_quantity" => $enter_product->total_quantity,
  "total_price" => $enter_product->total_price,
  "provider_id" => $enter_product->provider_id,
  "user_id" => $enter_product->user_id,
  "status" => $enter_product->status,
  "create_date" => $enter_product->create_date,
];
print_r(json_encode($enter_product_item));

?>
