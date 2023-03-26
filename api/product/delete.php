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

$data = json_decode(file_get_contents("php://input"));

$product->id = $data->id;

if($product->delete($product->id))
{
    echo json_encode(array('message','Product Deleted'));
}
else {
    echo json_encode(array('message','Product Not Deleted'));
}
?>
