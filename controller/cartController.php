<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\services\ordersServices.php";
include_once $filepath . "\services\detail_ordersServices.php";
class CartController
{
  public function addCart($cartAdd, $user_id)
  {
    //Get data from cart to add to order
    $total_price = 0;
    $total_quantity = 0;
    foreach ($cartAdd as $product) {
      $product_price = $product["price"];
      $product_quantity = $product["quantity"];
      $total_quantity = $total_quantity + $product_quantity;
      $total_price = $total_price + $product_price * $product_quantity;
    }
    $order_date = (string) date("d/m/Y");
    $payment_method = "cash";
    $status = "Đang giao hàng";
    $is_deleted = 0;

    //Add cart to order
    $orderService = new OrderServices();
    $result_order = $orderService->insert_order(
      $user_id,
      $total_quantity,
      $order_date,
      $total_price,
      $payment_method,
      $status,
      $is_deleted
    );
    if (isset($result_order) && $result_order == true) {
      $result_order_id = $orderService->get_order_id()->fetch_assoc();
      $order_id = $result_order_id["id"];
    }
    //Add product to detail order
    $detail_orderService = new DetailOrderServices();
    foreach ($cartAdd as $product) {
      $product_id = $product["id"];
      $product_price = $product["price"];
      $product_quantity = $product["quantity"];
      $result_detail_order = $detail_orderService->insert_detail_order(
        $order_id,
        $product_id,
        $product_quantity,
        $product_price
      );
    }
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
