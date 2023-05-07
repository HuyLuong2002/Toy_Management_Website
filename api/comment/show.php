<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/comment.php";

$db = new DB();
$connect = $db->connect();
$comment = new Comment($connect);
$comment->product_id = isset($_GET["productID"]) ? $_GET["productID"] : die();
$show = $comment->show($comment->product_id);
if ($show == false) {
  $comment_item = [
    "result" => "User ID comment not found",
  ];
} else {
  $comment_array = array();
  $comment_array['comment'] = [];
  while ($row = $show->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $comment_item = [
      "id" => $id,
      "content" => $content,
      "username" => $username,
      "product_id" => $product_id,
      "rate" => $rate,
      "time" => $time,
    ];
    //đẩy dữ liệu của mảng question_item vào mảng mới là category_array['data]
    array_push($comment_array["comment"], $comment_item);
  }
  echo json_encode($comment_array);

}


?>
