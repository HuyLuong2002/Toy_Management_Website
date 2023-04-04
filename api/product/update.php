<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/product.php";

$db = new DB();
$connect = $db->connect();

$product = new Product($connect);

$data = json_decode(file_get_contents("php://input"));

$product->id = isset($_GET["id"]) ? $_GET["id"] : die();
$product->name = $data->name;
$product->image = $data->image;
$product->price = $data->price;
$product->description = $data->description;
$product->create_date = $data->create_date;
$product->highlight = $data->highlight;
$product->category_id = $data->category_id;
$product->sale_id = $data->sale_id;
$product->review = $data->review;
$product->quantity = $data->quantity;

if($product->update())
{
    echo json_encode(array('message','Product Updated'));
}
else {
    echo json_encode(array('message','Product Not Updated'));
}
?>
