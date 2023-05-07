<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/comment.php";

$db = new DB();
$connect = $db->connect();
$comment = new Comment($connect);
$comment->user_id = isset($_GET["userID"]) ? $_GET["userID"] : die();
$result = $comment->show($comment->user_id);
if($result == false) {
  $comment_item = [
    "result" => "User ID comment not found",
  ];
}
else {
  $comment_item = [
    "id" => $comment->id,
    "content" => $comment->content,
    "user_id" => $comment->user_id,
    "product_id" => $comment->product_id,
    "reply_id" => $comment->reply_id,
    "rate" => $comment->rate,
    "time" => $comment->time,
  ];
}

print_r(json_encode($comment_item));

?>
