<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/account_function.php";

$db = new DB();
$connect = $db->connect();

$account_function = new AccountFunction($connect);

$data = json_decode(file_get_contents("php://input"));

$account_function->id = $data->id;

if($account_function->delete($account_function->id))
{
    echo json_encode(array('message','Account Function Deleted'));
}
else {
    echo json_encode(array('message','Account Function Not Deleted'));
}
?>
