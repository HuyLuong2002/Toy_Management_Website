<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header(
  "Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With"
);

include_once "../database/db.php";
include_once "../model/account.php";

$db = new DB();
$connect = $db->connect();

$account = new Account($connect);

$data = json_decode(file_get_contents("php://input"));

$account->username = $data->username;
$account->password = md5($data->password);
$account->firstname = $data->firstname;
$account->lastname = $data->lastname;
$account->gender = $data->gender;
$account->date_birth = $data->date_birth;
$account->place_of_birth = $data->place_of_birth;
$account->create_date = $data->create_date;
$account->permission_id = $data->permission_id;
$account->status = $data->status;

if ($account->create()) {
  echo json_encode(["message", "Account Created"]);
} else {
  echo json_encode(["message", "Account Not Created"]);
}
?>
