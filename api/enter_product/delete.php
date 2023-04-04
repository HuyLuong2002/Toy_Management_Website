<?php
use Ds\Pair;
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/enter_product.php";

$db = new DB();
$connect = $db->connect();

$enter_product = new EnterProduct($connect);


$enter_product->id = isset($_GET["id"]) ? $_GET["id"] : die();

if($enter_product->delete($enter_product->id))
{
    echo json_encode(array('message','Enter Product Deleted'));
}
else {
    echo json_encode(array('message','Enter Product Not Deleted'));
}
?>
