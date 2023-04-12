<?php
$filepath = realpath(dirname(__DIR__));
include_once($filepath . "\Toy_Management_Website\classes\product.php");
include_once $filepath . "\classes\product.php";

$product_detail = new Product();

if (isset($_GET["id"])) {
  $product_detail_id = $_GET["id"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Product Detail</title>
  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

  <!-- custom css file link  -->
  <link rel="stylesheet" href="./assets/css/orders.css" />
  <link rel="stylesheet" href="./assets/css/home.css" />
  <link rel="stylesheet" href="./assets/css/slide.css" />
  <link rel="stylesheet" href="./assets/css/footer.css" />
  <link rel="stylesheet" href="./assets/css/product_detail.css" />
</head>

<body>
  <?php include_once "./components/header.php"; ?>
  <?php
  $show_product_detail_id = $product_detail->show_product_detail($product_detail_id);
  if ($show_product_detail_id) {
    $result_product_detail = $show_product_detail_id->fetch_array();
    ?>
    <div class="main-wrapper">
      <div class="main-wrapper-container">
        <div class="product-div">
          <div class="product-div-left">

            <div class="img-container">
              <img src="<?php echo "admin/uploads/" . $result_product_detail[2] ?> " alt="watch image" id="product-image-<?php echo $result_product_detail[0]; ?>"/>
            </div>

            <div class="hover-container">
              <div>
                <img src="<?php echo "admin/uploads/" . $result_product_detail[2] ?>" alt="" />
              </div>

              <div>
                <img src="<?php echo "admin/uploads/" . $result_product_detail[2] ?>" alt="" />
              </div>

              <div>
                <img src="<?php echo "admin/uploads/" . $result_product_detail[2] ?>" alt="" />
              </div>
            </div>
          </div>

          <div class="product-div-right">
            <span class="product-name" id="product-name-<?php echo $result_product_detail[0] ?>">
              <?php echo $result_product_detail[1] ?>
            </span>
            <span class="product-price product-price-sale" id="product-price-<?php echo $result_product_detail[0]; ?>">
              <?php if ($result_product_detail[14] !== "Không áp dụng") {
                $sale_percent = $result_product_detail[18];
                $sale_price = $result_product_detail[3] -
                  $result_product_detail[3] * ($sale_percent / 100);
                echo "$" . $sale_price;
              } else {
                echo "$" . $result_product_detail[3];
              }
              ?>
            </span>
            <div class="product-rating">
              <?php
              $rating = $result_product_detail[9];
              for ($i = 0; $i < 5; $i++) {
                if ($rating > $i) {
                  echo "<span><i class='fas fa-star'></i></span>";
                } else {
                  echo "<span><i class='far fa-star'></i></span>";
                }
              }
              ?>
              <span>(250 ratings)</span>
            </div>
            <p class="product-description">
              Lorem Ipsum is simply dummy text of the printing and typesetting
              industry. Lorem Ipsum has been the industry's standard dummy text
              ever since the 1500s, when an unknown printer took a galley of
              type and scrambled it to make a type specimen book.
            </p>
            <div class="btn-groups">
              <button class="btn-cart" onclick="AddActive(event, <?php echo $result_product_detail[0]; ?>)"
                data-id="<?php echo $result_product_detail[0]; ?>" data-quantity=1>
                Add to cart
                <i class="fa-solid fa-plus add-icon" id="icon-check-<?php echo $result_product_detail[0]; ?>"></i>
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
    <?php
  }
  ?>

  <?php include "./components/footer.php"; ?>
  <script src="./js/product_detail.js"></script>

  <script>
    var icons = document.querySelectorAll('.favorite-icon i');
    icons.forEach((icon) => {
      var dataId = icon.getAttribute('data-id');
      var add_to_cart = JSON.parse(localStorage.getItem('favorite'));
      add_to_cart.forEach((product) => {
        if (product.id === dataId) {
          icon.classList.add('fa-solid');
          icon.classList.remove('fa-regular');
        }
      });

    });
  </script>
  <script src="./js/cartclick.js"></script>
</body>

</html>