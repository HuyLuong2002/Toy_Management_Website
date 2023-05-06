<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\Toy_Management_Website\lib\session.php";
include_once $filepath . "\Toy_Management_Website\controller\cartController.php";

Session::init();
$user_id = Session::get("userID");
if(empty($user_id))
{
    header("Location: login.php");
}
$cartAddCookie = isset($_COOKIE['cartAdd']) ? $_COOKIE['cartAdd'] : null;
$cartAdd = json_decode($cartAddCookie, true);
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($cartAdd))
{
    $cartController = new CartController();
    $alert = $cartController->addCart($cartAdd, $user_id);
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
            <a href="payment.php" class="checkout">Check Out</a>
        </div>
    </form>


    <script src="./js/cart.js">

    </script>