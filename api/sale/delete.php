<?php
use Ds\Pair;
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/sale.php";

$db = new DB();
$connect = $db->connect();

$sale = new Sale($connect);


$sale->id = isset($_GET["id"]) ? $_GET["id"] : die();

if($sale->delete($sale->id))
{
    echo json_encode(array('message','Sale Deleted'));
}
else {
    echo json_encode(array('message','Sale Not Deleted'));
}
?>
