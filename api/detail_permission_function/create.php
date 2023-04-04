<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/detail_permission_function.php";

$db = new DB();
$connect = $db->connect();

$detail_permission_function = new DetailPermissionFunction($connect);

$data = json_decode(file_get_contents("php://input"));

$detail_permission_function->permission_id = $data->permission_id;
$detail_permission_function->function_id = $data->function_id;
$detail_permission_function->action = $data->action;

if($detail_permission_function->create())
{
    echo json_encode(array('message','Detail Permission Function Created'));
}
else {
    echo json_encode(array('message','Detail Permission Function Not Created'));
}
?>
