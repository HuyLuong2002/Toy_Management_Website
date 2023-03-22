<?php
include_once "classes/product.php";

$product = new Product();
?>

<div id="home">
  <div class="slide-container">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="swiper-center">
            <img class="mySlides" src="./assets/images/home-img-1.png" />
          </div>
        </div>
        <div class="swiper-slide">
          <div class="swiper-center">
            <img class="mySlides" src="./assets/images/home-img-2.png" />
          </div>
        </div>
        <div class="swiper-slide">
          <div class="swiper-center">
            <img class="mySlides" src="./assets/images/home-img-3.png" />
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  </div>
</div>

<div class="products">
  <div class="product-container">
    <h1 class="lg-title">Latest Product</h1>
    <p class="text-light">
      Lorem Ipsum is simply dummy text of the printing and typesetting
      industry. Lorem Ipsum has been the industry's standard dummy text ever
      since the 1500s, when an unknown printer took a galley of type and
      scrambled it to make a type specimen book. It has survived not only five
      centuries, but also the leap into electronic typesetting, remaining
      essentially unchanged. It was popularised in the 1960s with the release
      of Letraset sheets containing Lorem Ipsum passages, and more recently
      with desktop publishing software like Aldus PageMaker including versions
      of Lorem Ipsum
    </p>

    <div class="product-items">
      <?php
      $show_product = $product->show_product();
      if ($show_product) {
        $i = 0;
        while ($result_product = $show_product->fetch_array()) {
          $i++; ?>
      <!-- Single product -->
      <div class="product">
        <div class="product-content">
          <div class="product-img">
            <img src="<?php echo $result_product[2]; ?>" alt="" />
          </div>
          <div class="product-btns">
            <button class="btn-cart">
              Add to cart
              <span><i class="fas fa-plus"> </i> </span>
            </button>

            <button class="btn-buy">
              Buy now
              <span><i class="fas fa-shopping-cart"> </i> </span>
            </button>
          </div>
        </div>
        <div class="product-info">
          <div class="product-info-top">
            <h2 class="sm-title"><?php echo $result_product[9]; ?></h2>
            <div class="rating">
              <?php
              $rating = $result_product[6];
              for ($i = 0; $i < 5; $i++) {
                if ($rating > $i) {
                  echo '<span><i class="fas fa-star"></i></span>';
                } else {
                  echo '<span><i class="far fa-star"></i></span>';
                }
              }
              ?>
            </div>
          </div>
          <a href="#" class="product-name"><?php echo $result_product[1]; ?></a>
          <?php echo $result_product[13] !== "Không áp dụng" ? "<p class='product-price product-price-linet'>$$result_product[3]</p>" : "";
           ?>
          <p class="product-price product-price-sale"> <?php if (
            $result_product[13] !== "Không áp dụng"
          ) {
            $sale_percent = $result_product[17];
            $sale_price = $result_product[3] - ($result_product[3] * ($sale_percent / 100));
            echo '$' . $sale_price;
          } else {
            echo '$' . $result_product[3];
          } ?></p>
        </div>
        <div class="off-info">
        <?php if ($result_product[13] === "Không áp dụng") {
          echo "";
        } else {
          $sale_percent = $result_product[17];
          echo "<h2 class='sm-title'>Sale $sale_percent%</h2>";
        } ?>
          
        </div>
      </div>
      <!-- end of single product -->
      <?php
        }
      }
      ?>
    </div>
  </div>
</div>
