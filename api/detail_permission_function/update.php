<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/detail_permission_function.php";

$db = new DB();
$connect = $db->connect();

$detail_permission_function = new DetailPermissionFunction($connect);

$data = json_decode(file_get_contents("php://input"));

$detail_permission_function->permission_id = isset($_GET["permissionid"]) ? $_GET["permissionid"] : die();
$detail_permission_function->function_id = isset($_GET["functionid"]) ? $_GET["functionid"] : die();
$detail_permission_function->id = isset($_GET["id"]) ? $_GET["id"] : die();
$detail_permission_function->action = $data->action;

if($detail_permission_function->update())
{
    echo json_encode(array('message','Detail Permission Function Updated'));
}
else {
    echo json_encode(array('message','Detail Permission Function Not Updated'));
}
?>
