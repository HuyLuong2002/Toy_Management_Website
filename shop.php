<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/shop.css">
    <link rel="stylesheet" href="./assets/css/home.css" />
    <link rel="stylesheet" href="./assets/css/footer.css" />
</head>

<body>
    <?php
    include("./components/header.php");
    ?>
    <section class="products">
        <h1 class="heading">Lastest products</h1>

        <div class="box-container">

            <form action="" method="post" class="box">
                <img src="./assets/images/home-img-3.png" alt="">
                <div class="name">Headphone ASUS</div>
                <div class="flex">
                    <div class="price"><span>$17000</span></div>
                    <input type="number" class="qty" name="qty" min="1" max="99" value="1">
                </div>
                <input type="submit" value="Add to cart" class="btn-addtocart">
            </form>

        </div>
    </section>
    <?php
    include("./components/footer.php");
    ?>