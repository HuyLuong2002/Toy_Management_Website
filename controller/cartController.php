<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\services\ordersServices.php";
include_once $filepath . "\services\detail_ordersServices.php";
class CartController
{
  public function addCart($cartAdd, $user_id)
  {
    $total_price = $cartAdd["totalPrice"];
    $total_quantity = count($cartAdd["product"]);
    $address = $cartAdd["address"];
    $country = $cartAdd["country"];
    $email = $cartAdd["email"];
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $date = date("d/m/Y H:i:s a");
    $phone = $cartAdd["telephone"];
    $status = "2";

    $orderService = new OrderServices();


    if ($result_detail_order == true && $result_order == true) {
      $alert = "<span class='success'>Add Cart Sucessfully</span>";
      // Xóa sản phẩm trong cookie
      setcookie("cartAdd", "", time() - 3600, "/");
      return $alert;
    } else {
      $alert = "<span class='success'>Add Cart Not Sucessfully</span>";
      return $alert;
    }

    //Ghi chú: cookie xóa đc nhưng localstorage vẫn còn
  }
}
?>
