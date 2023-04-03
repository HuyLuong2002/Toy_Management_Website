<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/category.php";

$db = new DB();
$connect = $db->connect();

$category = new Category($connect);


$category->id = isset($_GET["id"]) ? $_GET["id"] : die();

if($category->delete($category->id))
{
    echo json_encode(array('message','Category Deleted'));
}
else {
    echo json_encode(array('message','Category Not Deleted'));
}
?>
