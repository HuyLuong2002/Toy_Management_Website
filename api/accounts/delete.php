<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/account.php";

$db = new DB();
$connect = $db->connect();

$account = new Account($connect);

$data = json_decode(file_get_contents("php://input"));

$account->id = $data->id;

if($account->delete($account->id))
{
    echo json_encode(array('message','Account Deleted'));
}
else {
    echo json_encode(array('message','Account Not Deleted'));
}
?>
