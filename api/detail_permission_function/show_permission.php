<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/detail_permission_function.php";

$db = new DB();
$connect = $db->connect();
$detail_permission_function = new DetailPermissionFunction($connect);
$detail_permission_function->permission_id = isset($_GET["permissionid"])
  ? $_GET["permissionid"]
  : die();
$detail_permission_function->show_detail_permission(
  $detail_permission_function->permission_id
);
$detail_permission_function_item = [
  "function_id" => $detail_permission_function->function_id,
  "action" => $detail_permission_function->action,
];
print_r(json_encode($detail_permission_function_item));

?>
