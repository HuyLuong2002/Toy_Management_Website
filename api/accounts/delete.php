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


$account->id = isset($_GET["id"]) ? $_GET["id"] : die();

if($account->delete($account->id))
{
    echo json_encode(array('message','Account Deleted'));
}
else {
    echo json_encode(array('message','Account Not Deleted'));
}
?>
