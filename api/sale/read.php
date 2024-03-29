<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
include_once "../database/db.php";
include_once "../model/sale.php";

$db = new DB();
$connect = $db->connect();
$sale = new Sale($connect);
$read = $sale->read();

$num = $read->rowCount();
if ($num > 0) {
  $sale_array = [];
  $sale_array["sale"] = [];

  while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    /*
    extract($row);
    Hàm này sử dụng tên các phần tử trong mảng như tên của các biến 
    và giá trị của các phần tử trong mảng sẽ được gán cho các biến 
    tương ứng.
    */
    $sale_item = [
      "id" => $id,
      "name" => $name,
      "create_date" => $create_date,
      "start_date" => $start_date,
      "end_date" => $end_date,
      "percent_sale" => $percent_sale,
      "status" => $status,
    ];
    //đẩy dữ liệu của mảng question_item vào mảng mới là category_array['data]
    array_push($sale_array["sale"], $sale_item);
  }
  echo json_encode($sale_array);
}

?>
