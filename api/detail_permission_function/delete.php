<?php
use Ds\Pair;
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/detail_permission_function.php";

$db = new DB();
$connect = $db->connect();

$detail_permission_function = new DetailPermissionFunction($connect);


$detail_permission_function->permission_id = isset($_GET["permissionid"]) ? $_GET["permissionid"] : die();
$detail_permission_function->function_id = isset($_GET["functionid"]) ? $_GET["functionid"] : die();
$detail_permission_function->id = isset($_GET["id"]) ? $_GET["id"] : die();
if($detail_permission_function->delete())
{
    echo json_encode(array('message','Detail Permission Function Deleted'));
}
else {
    echo json_encode(array('message','Detail Permission Functions Deleted'));
}
?>
