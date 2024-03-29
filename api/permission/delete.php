<?php
use Ds\Pair;
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/permission.php";

$db = new DB();
$connect = $db->connect();

$permission = new Permission($connect);


$permission->id = isset($_GET["id"]) ? $_GET["id"] : die();

if($permission->delete())
{
    echo json_encode(array('message','Permission Deleted'));
}
else {
    echo json_encode(array('message','Permission Not Deleted'));
}
?>
