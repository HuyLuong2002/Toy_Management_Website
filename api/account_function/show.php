<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/account_function.php";

$db = new DB();
$connect = $db->connect();
$account_function = new AccountFunction($connect);
$account_function->id = isset($_GET["id"]) ? $_GET["id"] : die();
$account_function->show($account_function->id);
$account_function_item = [
  "id" => $account_function->id,
  "name" => $account_function->name,
];
print_r(json_encode($account_function_item));

?>
