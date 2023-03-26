<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/category.css">
    <link rel="stylesheet" href="./assets/css/home.css" />
    <link rel="stylesheet" href="./assets/css/slide.css">
    <link rel="stylesheet" href="./assets/css/footer.css" />
</head>

<body>
    <?php
    include_once("./components/header.php");
    ?>
    <div class="page-wrapper">
        <div class="breadcrumbs">
            <div class="container">
                <ul class="items">
                    <li class="item"><i class="fa-solid fa-house"></i><a href="#">Home</a></li>
                    <li class="item"><a href="#">Category</a></li>
                    <li class="item"><a href="#">Category</a></li>
                    <li class="item"><a href="#">Category</a></li>
                </ul>
            </div>
        </div>

        <div class="main-container">
            <div class="sidebar">
                <div class="sidebar-category">
                    <h3 class="title">Category</h3>
                    <ul class="o-list">
                        <li class="level0">
                            <a href="#">Smart Toys</a>
                            <i class="fa-solid fa-chevron-down"></i>
                        </li>
                        <li class="level0">
                            <a href="#">Robot</a>
                            <i class="fa-solid fa-chevron-down"></i>
                        </li>
                        <li class="level0">
                            <a href="#">LEGO</a>
                            <i class="fa-solid fa-chevron-down"></i>
                        </li>
                        <li class="level0">
                            <a href="#">Barie doll</a>
                            <i class="fa-solid fa-chevron-down"></i>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="list-product">
                <div class="product-wrapper">
                    <div class="catalog-product-item">
                        <div class="product-img-box">
                            <img src="./assets/images/home-img-1.png" class="product-img">
                        </div>
                        <div class="product-info">
                            <div class="product-detail">
                                <p class="name">Product One</p>
                                <p class="price">$22.00</p>
                            </div>
                            <button class="btn-addToCart">Add to Cart</button>       
                        </div>
                    </div>
                    <div class="catalog-product-item">
                        <div class="product-img-box">
                            <img src="./assets/images/home-img-1.png" class="product-img">
                        </div>
                        <div class="product-info">
                            <div class="product-detail">
                                <p class="name">Product One</p>
                                <p class="price">$22.00</p>
                            </div>
                            <button class="btn-addToCart">Add to Cart</button>       
                        </div>
                    </div>
                    <div class="catalog-product-item">
                        <div class="product-img-box">
                            <img src="./assets/images/home-img-1.png" class="product-img">
                        </div>
                        <div class="product-info">
                            <div class="product-detail">
                                <p class="name">Product One</p>
                                <p class="price">$22.00</p>
                            </div>
                            <button class="btn-addToCart">Add to Cart</button>       
                        </div>
                    </div>
                    <div class="catalog-product-item">
                        <div class="product-img-box">
                            <img src="./assets/images/home-img-1.png" class="product-img">
                        </div>
                        <div class="product-info">
                            <div class="product-detail">
                                <p class="name">Product One</p>
                                <p class="price">$22.00</p>
                            </div>
                            <button class="btn-addToCart">Add to Cart</button>       
                        </div>
                    </div>
                    <div class="catalog-product-item">
                        <div class="product-img-box">
                            <img src="./assets/images/home-img-1.png" class="product-img">
                        </div>
                        <div class="product-info">
                            <div class="product-detail">
                                <p class="name">Product One</p>
                                <p class="price">$22.00</p>
                            </div>
                            <button class="btn-addToCart">Add to Cart</button>       
                        </div>
                    </div>

                    <div class="bottom-pagination">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include("./components/footer.php");
    ?>
</body>