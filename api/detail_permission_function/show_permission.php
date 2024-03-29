<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/detail_permission_function.php";

$db = new DB();
$connect = $db->connect();
$detail_permission_function = new DetailPermissionFunction($connect);
$detail_permission_function->permission_id = isset($_GET["permissionid"])
  ? $_GET["permissionid"]
  : die();
$show_permission = $detail_permission_function->show_detail_permission();

$num = $show_permission->rowCount();
if ($num > 0) {
  $detail_permission_function_array = [];
  $detail_permission_function_array["detail_permission_function"] = [];

  while ($row = $show_permission->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    /*
      extract($row);
      Hàm này sử dụng tên các phần tử trong mảng như tên của các biến 
      và giá trị của các phần tử trong mảng sẽ được gán cho các biến 
      tương ứng.
      */
    $detail_permission_function_item = [
      "permission_id" => $permission_id,
      "function_list" => [
        "function_id" => $function_id,
        "action" => $action,
      ],
    ];

    array_push(
      $detail_permission_function_array["detail_permission_function"],
      $detail_permission_function_item
    );
  }
  echo json_encode($detail_permission_function_array);
}

?>
