<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/provider.php";

$db = new DB();
$connect = $db->connect();
$provider = new Provider($connect);
$provider->id = isset($_GET["id"]) ? $_GET["id"] : die();
$provider->show();
$provider_item = [
  "id" => $provider->id,
  "name" => $provider->name,
];
print_r(json_encode($provider_item));

?>
