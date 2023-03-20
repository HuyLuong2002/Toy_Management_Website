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
    <link rel="stylesheet" href="./assets/css/footer.css" />
</head>

<body>
    <?php
    include("./components/header.php");
    ?>
    <div class="category">
        <div class="header-category">
            <h2>Lastest products</h2>
            <p>
                <span id="previous">&#139;</span>
                <span id="next">&#155;</span>
            </p>
        </div>
        <section>
            <div class="product">
                <div class="picture">
                    <img src="./assets/images/home-img-1.png" alt="">
                </div>
                <div class="details">
                    <p>
                        <b>Product One</b>
                    </p>
                </div>
                <div class="star-button">
                    <p class="star">
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                    </p>
                    <label class="button" aria-hidden="true">Details</label>
                </div>
            </div>
            <div class="product">
                <div class="picture">
                    <img src="./assets/images/home-img-2.png" alt="">
                </div>
                <div class="details">
                    <p>
                        <b>Product Two</b>
                    </p>
                </div>
                <div class="star-button">
                    <p class="star">
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                    </p>
                    <label class="button" aria-hidden="true">Details</label>
                </div>
            </div>
            <div class="product">
                <div class="picture">
                    <img src="./assets/images/home-img-3.png" alt="">
                </div>
                <div class="details">
                    <p>
                        <b>Product Three</b>
                    </p>
                </div>
                <div class="star-button">
                    <p class="star">
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                    </p>
                    <label class="button" aria-hidden="true">Details</label>
                </div>
            </div>
            <div class="product">
                <div class="picture">
                    <img src="./assets/images/icon-1.png" alt="">
                </div>
                <div class="details">
                    <p>
                        <b>Product Four</b>
                    </p>
                </div>
                <div class="star-button">
                    <p class="star">
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                    </p>
                    <label class="button" aria-hidden="true">Details</label>
                </div>
            </div>
            <div class="product">
                <div class="picture">
                    <img src="./assets/images/icon-2.png" alt="">
                </div>
                <div class="details">
                    <p>
                        <b>Product Four</b>
                    </p>
                </div>
                <div class="star-button">
                    <p class="star">
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                    </p>
                    <label class="button" aria-hidden="true">Details</label>
                </div>
            </div>
            <div class="product">
                <div class="picture">
                    <img src="./assets/images/icon-3.png" alt="">
                </div>
                <div class="details">
                    <p>
                        <b>Product Four</b>
                    </p>
                </div>
                <div class="star-button">
                    <p class="star">
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                        <strong>&star;</strong>
                    </p>
                    <label class="button" aria-hidden="true">Details</label>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript" src="./js/category.js"></script>

    <?php
    include("./components/footer.php");
    ?>