<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/detail_permission_function.php";

$db = new DB();
$connect = $db->connect();
$detail_permission_function = new DetailPermissionFunction($connect);
$read = $detail_permission_function->read();

$num = $read->rowCount();
if ($num > 0) {
  $detail_permission_function_array = [];
  $detail_permission_function_array["detail_permission_function"] = [];

  while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    /*
    extract($row);
    Hàm này sử dụng tên các phần tử trong mảng như tên của các biến 
    và giá trị của các phần tử trong mảng sẽ được gán cho các biến 
    tương ứng.
    */
    $detail_permission_function_item = [
      "permission_id" => $permission_id, [
        "function_id" => $function_id,
        "action" => $action,
      ],
    ];
    //đẩy dữ liệu của mảng question_item vào mảng mới là category_array['data]
    array_push(
      $detail_permission_function_array["detail_permission_function"],
      $detail_permission_function_item
    );
  }
  echo json_encode($detail_permission_function_array);
}

?>
