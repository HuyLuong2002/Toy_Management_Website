<?php
// $filepath = realpath(dirname(__DIR__));
// include_once $filepath . "\Toy_Management_Website\lib\session.php";

// Session::checkSession();
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

    <div class="shopping-cart">

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

    <script src="./js/cart.js">

    </script>