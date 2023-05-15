<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="./assets/css/favorites.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <a href="index.php" class="return-btn">
        <i class="fa-solid fa-arrow-left fa-2xs"></i>
    </a>
    <a href="index.php" class="title">My favorites</a>
    <a href="cart.php" class="cart">
        <i class="fa-solid fa-cart-shopping fa-xl"></i>
        <span class="icon_status" id="cart">(0)</span>
    </a>

    <div class="shopping-cart">

        <div class="column-labels">
            <label class="product-image">Image</label>
            <label class="product-details">Product name</label>
            <label class="product-price">Price</label>
            <label class="product-more-detail">More Details</label>
            <label class="product-add-to-cart">Add To Cart</label>
            <label class="product-removal">Remove</label>
        </div>

        <div id="product-wrapper">

        </div>

    </div>

    <script src="./js/favorites.js">
    </script>
    <script src="./js/cartclick.js"></script>