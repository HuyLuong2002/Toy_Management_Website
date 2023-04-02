<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/product.php";

$db = new DB();
$connect = $db->connect();
$product = new Product($connect);
$product->id = isset($_GET["id"]) ? $_GET["id"] : die();
$product->show($product->id);
$product_item = [
  "id" => $product->id,
  "name" => $product->name,
  "image" => $product->image,
  "price" => $product->price,
  "description" => $product->description,
  "create_date" => $product->create_date,
  "highlight" => $product->highlight,
  "category_id" => $product->category_id,
  "sale_id" => $product->sale_id,
  "review" => $product->review,
  "quantity" => $product->quantity,
];
print_r(json_encode($product_item));

?>
