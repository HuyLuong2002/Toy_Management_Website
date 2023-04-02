<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/permission.php";

$db = new DB();
$connect = $db->connect();
$permission = new Permission($connect);
$permission->id = isset($_GET["id"]) ? $_GET["id"] : die();
$permission->show($permission->id);
$permission_item = [
  "id" => $permission->id,
  "name" => $permission->name,
];
print_r(json_encode($permission_item));

?>
