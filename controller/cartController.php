<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\services\ordersServices.php";
include_once $filepath . "\services\detail_ordersServices.php";
class CartController
{
  public function addCart($cartAdd, $user_id)
  {
    $total_price = (string) $cartAdd["totalPrice"];
    $total_quantity = count($cartAdd["product"]);
    $address = $cartAdd["address"];
    $country = $cartAdd["country"];
    $email = $cartAdd["email"];
    $ship_method = $cartAdd["shipMethod"];
    $vat = $cartAdd["vat"];
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $date = date("d/m/Y H:i:s a");
    $phone = $cartAdd["telephone"];
    $status = "2";
    $user_id = $cartAdd["user_id"];
    $payment_method = $cartAdd["paymentMethod"];

    $orderService = new OrderServices();
    $result_order = $orderService->insert_order($user_id, $total_quantity, $date, $address, $phone, $email, $country, $vat, $ship_method,  $total_price, $payment_method, $status, 0);
    $order_id = $orderService->get_order_id()->fetch_assoc()["id"];

    $detail_orderService = new DetailOrderServices();
    $productList = $cartAdd["product"];
    if($result_order == true) {
      foreach($productList as $product)
      {
          $result_detail_order = $detail_orderService->insert_detail_order($order_id, $product["id"], $product["quantity"], $product["price"]);
      }
    }

    if ($result_detail_order == true && $result_order == true) {

      $alert = "<span class='success'>Add Cart Sucessfully</span>";
      // Xóa sản phẩm trong cookie
      setcookie("Order", "", time() - 3600, "/");
      return $alert;
    } else {
      $alert = "<span class='success'>Add Cart Not Sucessfully</span>";
      return $alert;
    }
  }
}
?>
