<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/category.php";

$db = new DB();
$connect = $db->connect();

$category = new Category($connect);

$data = json_decode(file_get_contents("php://input"));

$category->id = isset($_GET["id"]) ? $_GET["id"] : die();
$category->name = $data->name;

if($category->update($category->id))
{
    echo json_encode(array('message','Category Updated'));
}
else {
    echo json_encode(array('message','Category Not Updated'));
}
?>
