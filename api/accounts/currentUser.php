<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
$filepath = $_SERVER['DOCUMENT_ROOT'];
include_once "../database/db.php";
include_once $filepath . "/lib/session.php";
include_once "../model/account.php";

Session::init();
$user_id = Session::get("userID");
$db = new DB();
$connect = $db->connect();
$account = new Account($connect);

$account->id = $user_id;
$account->show();
$account_item = [
  "id" => $account->id,
  "username" => $account->username,
  "password" => $account->password,
  "firstname" => $account->firstname,
  "lastname" => $account->lastname,
  "gender" => $account->gender,
  "date_birth" => $account->date_birth,
  "place_of_birth" => $account->place_of_birth,
  "create_date" => $account->create_date,
  "permission_id" => $account->permission_id,
  "status" => $account->status,
];
print_r(json_encode($account_item));

?>
