<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/product.php";

$db = new DB();
$connect = $db->connect();

$product = new Product($connect);

$product->id = isset($_GET["id"]) ? $_GET["id"] : die();

if($product->delete())
{
    echo json_encode(array('message','Product Deleted'));
}
else {
    echo json_encode(array('message','Product Not Deleted'));
}
?>
