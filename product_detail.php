<?php
$filepath = realpath(dirname(__DIR__));
include_once($filepath . "/Toy_Management_Website/controller/product_detailController.php");
include_once $filepath . "/controller/productsController.php";
include_once $filepath . "/controller/commentController.php";
include_once($filepath . "/helpers/format.php");
include_once "./lib/session.php";

Session::init();
$user_id = Session::get("userID");

$fm = new Format();
$product_detailController = new ProductDetailController();
$commentController = new CommentController();
$productsController = new ProductsController();
if (isset($_GET["id"])) {
  $product_detail_id = $_GET["id"];
}

if (isset($_GET["categoryID"])) {
  $product_detail_category = $_GET["categoryID"];
}

$countComment = $commentController->show_all_comment_of_product($product_detail_id);
if(isset($countComment->num_rows))
  $ratingCount = $countComment->num_rows;
else {
  $ratingCount = 0;
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
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

  <!-- custom css file link  -->
  <link rel="stylesheet" href="./assets/css/orders.css" />
  <link rel="stylesheet" href="./assets/css/home.css" />
  <link rel="stylesheet" href="./assets/css/slide.css" />
  <link rel="stylesheet" href="./assets/css/footer.css" />
  <link rel="stylesheet" href="./assets/css/product_list.css" />
  <link rel="stylesheet" href="./assets/css/product_detail.css" />
</head>

<body>
  <?php include_once "./components/header.php"; ?>
  <?php
  $show_product_detail_id = $product_detailController->show_product_detail($product_detail_id);
  if ($show_product_detail_id) {
    $result_product_detail = $show_product_detail_id->fetch_array();
  ?>
    <div class="main-wrapper">
      <div class="main-wrapper-container">
        <div class="product-div">
          <div class="product-div-left">

            <div class="img-container">
              <img src="<?php echo "admin/uploads/" . $result_product_detail[2] ?> " alt="watch image" id="product-image-<?php echo $result_product_detail[0]; ?>" />
            </div>
          </div>

          <div class="product-div-right">
            <span class="product-name" id="product-name-<?php echo $result_product_detail[0] ?>">
              <?php echo $result_product_detail[1] ?>
            </span>
            <span class="product-price product-price-sale">
              <?php if ($result_product_detail[18] !== "Không áp dụng") {
                $sale_percent = $result_product_detail[20];
                $sale_price = $result_product_detail[3] - $result_product_detail[3] * ($sale_percent / 100);
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
              <span>(<?php echo $ratingCount; ?>)</span>
            </div>
            <div class="product-description">
              <?php
              echo $fm->textShorten($result_product_detail[4], 50);
              ?>
            </div>
            <div class="btn-groups">
              <button class="btn-cart" onclick="AddActive(event, <?php echo $result_product_detail[0]; ?>)" data-id="<?php echo $result_product_detail[0]; ?>" data-quantity=1>
                Add to cart
                <i class="fa-solid fa-plus add-icon" id="icon-check-<?php echo $result_product_detail[0]; ?>"></i>
              </button>

              <button type="button" class="buy-now-btn">
                <i class="fas fa-wallet"></i> Buy now
              </button>
            </div>
          </div>

          <div class="product-information">
            <?php
            echo $fm->textShorten($result_product_detail[4]);
            ?>
          </div>

          <div class="product-review">
            <span onclick="HandleShowListReview()">See all reviews ...</span>
          </div>

        </div>

      </div>
    </div>

    <div class="wrap-list-reviews" id="wrap-list-reviews">

      <div class="list-reviews">
        <span onclick="handleClose()">&times;</span>
        <h2>List Reviews</h2>
        <div class="wrap-reviews">
          <div class="write-review">
            <div class="wrapper">
              <h3>Write some review of this product.</h3>
              <form action="#">
                <div class="rating">
                  <input type="number" name="rating" hidden>
                  <i class='bx bx-star star' style="--i: 0;"></i>
                  <i class='bx bx-star star' style="--i: 1;"></i>
                  <i class='bx bx-star star' style="--i: 2;"></i>
                  <i class='bx bx-star star' style="--i: 3;"></i>
                  <i class='bx bx-star star' style="--i: 4;"></i>
                </div>
                <textarea id="review-opinion" required name="opinion" cols="30" rows="5" placeholder="Your opinion..."></textarea>
                <div class="btn-group">
                  <button type="submit" class="btn submit" id="submit-review" onclick="handleAddReview(event, <?php echo $user_id; ?>, <?php echo $product_detail_id; ?>)">Submit</button>
                  <button class="btn cancel" onclick="handleClose()">Cancel</button>
                </div>
              </form>
            </div>
          </div>

          <div class="list-user-review" id="list-user-review">

            <!-- <div class="use-review">
              <img src="./assets/images/pic-6.png" alt="">
              <div class="detail-review">
                <p style="font-weight: 900;">Huyền cute</p>
                <p>San pham nhu cai dau bui San pham nhu cai dau buiSan pham nhu cai dau bui </p>
                <div class="more-detail">
                  <div class="rating">
                    <input type="number" name="rating" hidden>
                    <i class='bx bxs-star' style="--i: 0;"></i>
                    <i class='bx bxs-star' style="--i: 1;"></i>
                    <i class='bx bxs-star' style="--i: 2;"></i>
                    <i class='bx bxs-star' style="--i: 3;"></i>
                    <i class='bx bx-star' style="--i: 4;"></i>
                  </div>
                  <span>23/04/2022, 10:05:27</span>
                </div>
              </div>
            </div> -->
          </div>

        </div>
      
        <div class="add-status add-success" id="add-success">
          <span>&#x2713;</span> review was added
        </div>

        <div class="add-status add-fail" id="add-fail">
          <span>&times;</span> add review failed
        </div>
      </div>

      
    </div>

  <?php
  }
  ?>
  <div class="related-products">Related Products</div>
  <div class="product-container">

    <div class="product-items" id="product-items">
      <?php
      $show_related_products = $productsController->show_product_by_category_id_unique($product_detail_category, $product_detail_id);
      if ($show_related_products) {
        while ($result_product = $show_related_products->fetch_array()) {
      ?>
          <!-- Single product -->
          <div class="product id-<?php echo $result_product[0] ?>">
            <div class="product-content">
              <div class="product-img">
                <img src="<?php echo "admin/uploads/" . $result_product[2]; ?>" alt="" id="product-image-<?php echo $result_product[0]; ?>" />
              </div>
              <div class="product-btns">
                <button class="btn-cart" onclick="AddActive(event, <?php echo $result_product[0]; ?>)" data-id="<?php echo $result_product[0]; ?>" data-quantity=1>
                  Add to cart
                  <i class="fa-solid fa-plus add-icon" id="icon-check-<?php echo $result_product[0]; ?>"></i>
                </button>
                <a href="product_detail.php?id=<?php echo $result_product[0]; ?>&categoryID=<?php echo $result_product[7]; ?>">
                  <button class="btn-buy">
                    More Details
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
                <div class="related-rating">
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
              <a href="product_detail.php?id=<?php echo $result_product[0]; ?>&categoryID=<?php echo $result_product[7]; ?>" class="product-name" id="product-name-<?php echo $result_product[0]; ?>">
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
    </div>

  </div>

  <?php include "./components/footer.php"; ?>
  <script src="./js/product_detail.js"></script>

  <script src="./js/newWishList.js"></script>
  <script src="./js/cartclick.js"></script>
  <script src="./js/loadMoreProduct.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
          $('#scroll').fadeIn();
        } else {
          $('#scroll').fadeOut();
        }
      });
      $('#scroll').click(function() {
        $("html, body").animate({
          scrollTop: 0
        }, 600);
        return false;
      });
    });
  </script>
  <script src="./js/product_detail_listReview.js"></script>
  <script>
    const allStar = document.querySelectorAll('.rating .star')
    const ratingValue = document.querySelector('.rating input')

    allStar.forEach((item, idx) => {
      item.addEventListener('click', function() {
        let click = 0
        ratingValue.value = idx + 1

        allStar.forEach(i => {
          i.classList.replace('bxs-star', 'bx-star')
          i.classList.remove('active')
        })
        for (let i = 0; i < allStar.length; i++) {
          if (i <= idx) {
            allStar[i].classList.replace('bx-star', 'bxs-star')
            allStar[i].classList.add('active')
          } else {
            allStar[i].style.setProperty('--i', click)
            click++
          }
        }
      })
    })
  </script>
  
</body>

</html>