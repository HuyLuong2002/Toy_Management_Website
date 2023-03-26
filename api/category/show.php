<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/category.php";

$db = new DB();
$connect = $db->connect();
$category = new Category($connect);
$category->id = isset($_GET["id"]) ? $_GET["id"] : die();
$category->show($category->id);
$category_item = [
  "id" => $category->id,
  "name" => $category->name,
];
print_r(json_encode($category_item));

?>
