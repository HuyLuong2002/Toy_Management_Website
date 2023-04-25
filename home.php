<?php
$filepath = realpath(dirname(__DIR__));
include_once($filepath . "\Toy_Management_Website\controller\productsController.php");

$productsController = new ProductsController();
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

<div class="add_to_cart">
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
      $show_product = $productsController->show_product_user();
      if ($show_product) {
        while ($result_product = $show_product->fetch_array()) {
      ?>
          <!-- Single product -->
          <div class="product">
            <div class="product-content">
              <div class="product-img">
                <img src="<?php echo "admin/uploads/" . $result_product[2]; ?>" alt="" id="product-image-<?php echo $result_product[0]; ?>" />
              </div>
              <div class="product-btns">
                <button class="btn-cart" onclick="AddActive(event, <?php echo $result_product[0]; ?>)" data-id="<?php echo $result_product[0]; ?>" data-quantity=1>
                  Add to cart
                  <i class="fa-solid fa-plus add-icon" id="icon-check-<?php echo $result_product[0]; ?>"></i>
                </button>
                <a href="product_detail.php?id=<?php echo $result_product[0]; ?>">
                  <button class="btn-buy">
                    Buy now
                    <span><i class="fas fa-shopping-cart"> </i> </span>
                  </button>
                </a>
              </div>
            </div>
            <div class="product-info">
              <div class="product-info-top">
                <h2 class="sm-title">
                  <?php echo $result_product[13]; ?>
                </h2>
                <div class="rating">
                  <?php
                  $rating = $result_product[9];
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
              <a href="product_detail.php?id=<?php echo $result_product[0]; ?>" class="product-name" id="product-name-<?php echo $result_product[0]; ?>">
                <?php echo $result_product[1]; ?>
              </a>
              <?php echo $result_product[16] !== "Không áp dụng" ? "<p class='product-price product-price-linet'>$" . $result_product[3] . "</p>" : "";
              ?>
              <p class="product-price product-price-sale" id="product-price-<?php echo $result_product[0]; ?>">
                <?php if (
                  $result_product[16] !== "Không áp dụng"
                ) {
                  $sale_percent = $result_product[20];
                  $sale_price = $result_product[3] - ($result_product[3] * ($sale_percent / 100));
                  echo '$' . $sale_price;
                } else {
                  echo '$' . $result_product[3];
                } ?>
              </p>
            </div>
            <div class="off-info">
              <?php if ($result_product[16] === "Không áp dụng") {
                echo "";
              } else {
                $sale_percent = $result_product[20];
                echo "<h2 class='sm-title'>Sale $sale_percent%</h2>";
              }
              ?>

              <div class="favorite-icon" onclick="AddFavorite(event, <?php echo $result_product[0]; ?>)">
                <i class="fa-regular fa-heart fav-icon" id="favorite-<?php echo $result_product[0]; ?>" data-id="<?php echo $result_product[0]; ?>"></i>
              </div>
            </div>
          </div>
          <!-- end of single product -->
      <?php
        }
      }
      ?>
      <div id="load-more">Load More <i class="fa-solid fa-circle-arrow-down"></i></div>
      <div id="unload-more">Unload More <i class="fa-solid fa-circle-arrow-up"></i></div>
    </div>
  </div>
  <div id="scroll" class="totop">
    <a>
      <span></span>
      <!-- <i class="fa-solid fa-chevron-up"></i> -->
    </a>
  </div>
</div>
<script src="./js/newWishList.js"></script>
<script src="./js/cartclick.js"></script>

<script>
  let loadmoreBtn = document.querySelector('#load-more');
  let unloadmoreBtn = document.getElementById("unload-more");
  console.log(unloadmoreBtn);
  let products = [...document.querySelectorAll('.product')];
  let currentItem = 4;

  loadmoreBtn.onclick = () => {
    // for (var i = currentItem; i < currentItem + 4; i++){
    //   products[i].style.display = 'block';
    // }
    // currentItem += 4;
    products.forEach(element => {
      currentItem += products.length
      element.style.display = 'block';
    });

    if (currentItem >= products.length) {
      loadmoreBtn.style.display = 'none';
      unloadmoreBtn.style.display = 'inline-block';
    }
  }

  unloadmoreBtn.onclick = () => {
    for (var i = 4; i < products.length; i++) {
      products[i].style.display = 'none';
    }
    if (loadmoreBtn !== null && unloadmoreBtn !== null) {
      loadmoreBtn.style.display = 'inline-block';
      unloadmoreBtn.style.display = 'none';
    }
  }
</script>

<script type="text/javascript">
  $(document).ready(function(){ 
    $(window).scroll(function(){ 
        if ($(this).scrollTop() > 100) { 
            $('#scroll').fadeIn(); 
        } else { 
            $('#scroll').fadeOut(); 
        } 
    }); 
    $('#scroll').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 600); 
        return false; 
    }); 
});
</script>