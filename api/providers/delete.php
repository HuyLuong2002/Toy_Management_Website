<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/provider.php";

$db = new DB();
$connect = $db->connect();

$provider = new Provider($connect);

$data = json_decode(file_get_contents("php://input"));
//là một hàm trong PHP để đọc dữ liệu được gửi đến server thông qua phương thức POST hoặc PUT.
/*
php://input là một wrapper stream (stream bao) trong PHP, 
cho phép bạn đọc dữ liệu từ HTTP message body một cách dễ dàng. 
Hàm file_get_contents() được sử dụng để đọc nội dung của wrapper stream 
này, giúp lấy được dữ liệu được gửi từ client.
*/

$provider->id = $data->id;

if ($provider->delete($provider->id)) {
  echo json_encode(["message", "Provider Deleted"]);
} else {
  echo json_encode(["message", "Provider Not Deleted"]);
}
?>
