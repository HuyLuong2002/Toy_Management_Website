<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/enter_product.php";

$db = new DB();
$connect = $db->connect();
$enter_product = new EnterProduct($connect);
$read = $enter_product->read();

$num = $read->rowCount();
if ($num > 0) {
  $enter_product_array = [];
  $enter_product_array["enter_product"] = [];

  while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    /*
    extract($row);
    Hàm này sử dụng tên các phần tử trong mảng như tên của các biến 
    và giá trị của các phần tử trong mảng sẽ được gán cho các biến 
    tương ứng.
    */
    $enter_product_item = [
      "id" => $id,
      "enter_date" => $enter_date,
      "total_quantity" => $total_quantity,
      "total_price" => $total_price,
      "provider_id" => $provider_id,
      "user_id" => $user_id,
      "status" => $status,
      "create_date" => $create_date,
    ];
    //đẩy dữ liệu của mảng question_item vào mảng mới là category_array['data]
    array_push($enter_product_array["enter_product"], $enter_product_item);
  }
  echo json_encode($enter_product_array);
}

?>
