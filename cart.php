<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\Toy_Management_Website\lib\session.php";
include_once $filepath . "\Toy_Management_Website\controller\cartController.php";

Session::init();
$user_id = Session::get("userID");
if (empty($user_id)) {
    header("Location: login.php");
}
$cartAddCookie = isset($_COOKIE['Order']) ? $_COOKIE['Order'] : null;
$cartAdd = json_decode($cartAddCookie, true);
if (isset($cartAdd)) {
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

</head>

<body>

    <a href="index.php" class="return-btn"><i class="fa-solid fa-arrow-left"></i></a>

    <form action="cart.php" method="post">
        <div class="shopping-cart">
            <?php
            if (isset($alert)) {
                echo '<div class="check-info check-success" id="check-success">
                        <span>&#x2713;</span> Place Order Successfully
                    </div>';
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
            <a href="payment.php" onclick="handleCheckCheckOut(event)" class="checkout">Check Out</a>
        </div>
    </form>

    <div class="cart-status cart-fail" id="cart-fail">
        <span>&times;</span> Cart is empty
    </div>

    <div class="cart-status-1 cart-fail-1" id="cart-fail-1">
        <span>&times;</span> This product is out of stock
    </div>

    <script src="./js/cart.js">

    </script>

    <script>
        let checkSuccess = document.getElementById("check-success")
        if(checkSuccess) {
            checkSuccess.style.display = "block"
            checkSuccess.classList.add("hide")

            setTimeout(function() {
                checkSuccess.style.display = 'none';
                checkSuccess.classList.remove('hide');
            }, 3000);
        }
    </script>

    <script>


    </script>