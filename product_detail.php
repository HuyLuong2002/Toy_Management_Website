<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Detail</title>
    <!-- font awesome cdn link  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="./assets/css/orders.css" />
    <link rel="stylesheet" href="./assets/css/home.css" />
    <link rel="stylesheet" href="./assets/css/slide.css" />
    <link rel="stylesheet" href="./assets/css/footer.css" />
    <link rel="stylesheet" href="./assets/css/product_detail.css" />
  </head>
  <body>
    <?php include_once "./components/header.php"; ?>

    <div class="main-wrapper">
      <div class="main-wrapper-container">
        <div class="product-div">
          <div class="product-div-left">
            <div class="img-container">
              <img src="./assets/images/home-img-1.png" alt="watch image" />
            </div>

            <div class="hover-container">
              <div>
                <img src="./assets/images/home-img-1.png" alt="" />
              </div>

              <div>
                <img src="./assets/images/home-img-2.png" alt="" />
              </div>

              <div>
                <img src="./assets/images/home-img-3.png" alt="" />
              </div>
            </div>
          </div>

          <div class="product-div-right">
            <span class="product-name"> Product 1 </span>
            <span class="product-price"> $50.25 </span>
            <div class="product-rating">
              <span>
                <i class="fas fa-star"> </i>
              </span>
              <span>
                <i class="fas fa-star"> </i>
              </span>
              <span>
                <i class="fas fa-star"> </i>
              </span>
              <span>
                <i class="fas fa-star"> </i>
              </span>
              <span>
                <i class="far fa-star"> </i>
              </span>
              <span>(250 ratings)</span>
            </div>
            <p class="product-description">
              Lorem Ipsum is simply dummy text of the printing and typesetting
              industry. Lorem Ipsum has been the industry's standard dummy text
              ever since the 1500s, when an unknown printer took a galley of
              type and scrambled it to make a type specimen book.
            </p>
            <div class="btn-groups">
              <button type="button" class="add-cart-btn">
                <i class="fas fa-shopping-cart"></i> Add to cart
              </button>

              <button type="button" class="buy-now-btn">
                <i class="fas fa-wallet"></i> Buy now
              </button>
            </div>
          </div>

          <div class="product-information">
          <div class="product-content">
            <span>
              Lorem Ipsum is simply dummy text of the printing and typesetting
              industry. Lorem Ipsum has been the industry's standard dummy text
              ever since the 1500s, when an unknown printer took a galley of
              type and scrambled it to make a type specimen book.
            </span>
          </div>
        </div>
        </div>

      </div>
    </div>

    <?php include "./components/footer.php"; ?>
    <script src="./js/product_detail.js"></script>
  </body>
</html>
