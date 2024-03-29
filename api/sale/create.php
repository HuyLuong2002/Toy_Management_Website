<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/sale.php";

$db = new DB();
$connect = $db->connect();

$sale = new Sale($connect);

$data = json_decode(file_get_contents("php://input"));

$sale->name = $data->name;
$sale->create_date = (string) date("d/m/Y");
$sale->start_date = $data->start_date;
$sale->end_date = $data->end_date;
$sale->percent_sale = $data->percent_sale;
$sale->status = $data->status;

if($sale->create())
{
    echo json_encode(array('message','Sale Created'));
}
else {
    echo json_encode(array('message','Sale Not Created'));
}
?>
