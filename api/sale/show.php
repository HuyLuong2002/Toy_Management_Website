<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/sale.php";

$db = new DB();
$connect = $db->connect();
$sale = new Sale($connect);
$sale->id = isset($_GET["id"]) ? $_GET["id"] : die();
$sale->show();
$sale_item = [
  "id" => $sale->id,
  "name" => $sale->name,
  "create_date" => $sale->create_date,
  "start_date" => $sale->start_date,
  "end_date" => $sale->end_date,
  "percent_sale" => $sale->percent_sale,
  "status" => $sale->status,
];
print_r(json_encode($sale_item));

?>
