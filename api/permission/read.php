<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/permission.php";

$db = new DB();
$connect = $db->connect();
$permission = new Permission($connect);
$read = $permission->read();

$num = $read->rowCount();
if ($num > 0) {
  $permission_array = [];
  $permission_array["permission"] = [];

  while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    /*
    extract($row);
    Hàm này sử dụng tên các phần tử trong mảng như tên của các biến 
    và giá trị của các phần tử trong mảng sẽ được gán cho các biến 
    tương ứng.
    */
    $permission_item = [
      "id" => $id,
      "name" => $name,
    ];
    //đẩy dữ liệu của mảng question_item vào mảng mới là category_array['data]
    array_push($permission_array["permission"], $permission_item);
  }
  echo json_encode($permission_array);
}

?>
