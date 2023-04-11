<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\Toy_Management_Website\lib\session.php";
include_once $filepath . "\Toy_Management_Website\classes\order.php";
include_once $filepath . "\classes\detail_order.php";

Session::init();
$user_id = Session::get("userID");
if(empty($user_id))
{
    header("Location: login.php");
}
$cartAddCookie = isset($_COOKIE['cartAdd']) ? $_COOKIE['cartAdd'] : null;
$cartAdd = json_decode($cartAddCookie, true);
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //Get data from cart to add to order
    $total_price = 0;
    $total_quantity = 0;
    foreach ($cartAdd as $product) {
        $product_price = $product['price'];
        $product_quantity = $product['quantity'];
        $total_quantity = $total_quantity + $product_quantity;
        $total_price = $total_price + ($product_price * $product_quantity);
    }
    $order_date = (string) date("d/m/Y");
    $payment_method = "cash";
    $status = "Đang giao hàng";
    $is_deleted = 0;
    //Add cart to order
    $order = new Order();
    $result_order = $order->insert_order($user_id, $total_quantity, $order_date, $total_price, $payment_method, $status, $is_deleted);
    if(isset($result_order) && $result_order == true)
    {
        $result_order_id = $order->get_order_id()->fetch_assoc();
        $order_id = $result_order_id["id"];
    }
    //Add product to detail order
    $detail_order = new DetailOrder();
    foreach ($cartAdd as $product) {
        $product_id = $product["id"];
        $product_price = $product['price'];
        $product_quantity = $product['quantity'];
        $result_detail_order = $detail_order->insert_detail_order($order_id, $product_id, $product_quantity, $product_price);
    }
    if($result_detail_order == true && $result_order == true) {
        $alert = "<span class='success'>Add Cart Sucessfully</span>";
    }
    else {
        $alert = "<span class='success'>Add Cart Not Sucessfully</span>";
    }
    // Xóa sản phẩm trong cookie
    setcookie('cartAdd', '', time() - 3600, '/');
    //Ghi chú: cookie xóa đc nhưng localstorage vẫn còn
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="./assets/css/cart.css">
</head>

<body>

    <a href="index.php">Shopping Cart</a>

    <form action="cart.php" method="post">
        <div class="shopping-cart">
            <?php
                if(isset($alert))
                {
                    echo $alert;
                }
            ?>

            <div class="column-labels">
                <label class="product-image">Image</label>
                <label class="product-details">Product</label>
                <label class="product-price">Price</label>
                <label class="product-quantity">Quantity</label>
                <label class="product-line-price">Total</label>
                <label class="product-removal">Remove</label>
            </div>

            <div id="product-wrapper">
            
            </div>

            <div id="wrap-total">
                
            </div>

            <button class="checkout">Checkout</button>
        </div>
    </form>


    <script src="./js/cart.js">

    </script>