<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/account_function.php";

$db = new DB();
$connect = $db->connect();

$account_function = new AccountFunction($connect);

$data = json_decode(file_get_contents("php://input"));

$account_function->id = isset($_GET["id"]) ? $_GET["id"] : die();
$account_function->name = $data->name;

if($account_function->update($account_function->id))
{
    echo json_encode(array('message','Account Function Updated'));
}
else {
    echo json_encode(array('message','Account Function Not Updated'));
}
?>
