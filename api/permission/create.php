<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/permission.php";

$db = new DB();
$connect = $db->connect();

$permission = new Permission($connect);

$data = json_decode(file_get_contents("php://input"));

$permission->name = $data->name;

if($permission->create())
{
    echo json_encode(array('message','Permission Created'));
}
else {
    echo json_encode(array('message','Permission Not Created'));
}
?>
