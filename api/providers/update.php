<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/provider.php";

$db = new DB();
$connect = $db->connect();

$provider = new Provider($connect);

$data = json_decode(file_get_contents("php://input"));

$provider->id = $data->id;
$provider->name = $data->name;

if($provider->update($provider->id))
{
    echo json_encode(array('message','Provider Updated'));
}
else {
    echo json_encode(array('message','Provider Not Updated'));
}
?>
