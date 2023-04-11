<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\Toy_Management_Website\classes\category.php";
include_once $filepath . "\classes\product.php";
$category = new Category();
$product = new Product();
if (isset($_GET["id"])) {
  $category_id = $_GET["id"];
}
if (isset($_GET["page"])) {
  $page_id = $_GET["page"];
}

/*
Tính giá trị của phân trang
10 sản phẩm trên 1 trang
*/
$result_pagination = $product->show_product_by_category_id($category_id);

/*
Tính giá trị của phân trang
10 sản phẩm trên 1 trang
*/
// Tổng số sản phẩm
$product_total = mysqli_num_rows($result_pagination);
//số sản phẩm trên 1 trang
$num_product_on_page = 10;
$page_total = ceil($product_total / $num_product_on_page);
//Trang hiện tại
$current_page = $page_id;
// vị trí hiện tại
$current_position = ($current_page - 1) * $num_product_on_page;
$result_pagination = $product->show_product_by_category_panigation(
  $category_id,
  $current_position,
  $num_product_on_page
);
?>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
  <?php include_once "./components/header.php"; ?>
  <div class="page-wrapper">
    <div class="breadcrumbs">
      <div class="container">
        <ul class="items">
          <li class="item"><i class="fa-solid fa-house"></i><a href="index.php">Home</a></li>
          <?php
          $show_category_by_id = $category->show_category_by_id($category_id);
          if ($show_category_by_id) {
            $result = $show_category_by_id->fetch_assoc(); ?>
            <li class="item"><a href="category.php?id=<?php echo $result["id"]; ?>&page=1">
                <?php echo $result["name"]; ?>
              </a></li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>

    <div class="main-container container">
      <div class="sidebar">
        <div class="sidebar-category">
          <h3 class="title">Category</h3>
          <ul class="main-list">
            <?php
            $show_category = $category->show_category();
            if ($show_category) {
              while ($result = $show_category->fetch_assoc()) { ?>
                <li data-id="<?php echo $result["id"]; ?>">
                  <a href="category.php?id=<?php echo $result["id"]; ?>&page=1">
                    <?php echo $result["name"]; ?>
                  </a>
                </li>
            <?php }
            }
            ?>
          </ul>
        </div>
      </div>

      <div class="list-product">
        <div class="product-wrapper" id="product-data">
          <?php if ($result_pagination) {
            while ($result_product = $result_pagination->fetch_array()) { ?>
              <div class="catalog-product-item">
                <div class="product-content">
                  <div class="product-img-box">
                    <img src="<?php echo " admin/uploads/" .
                                $result_product[2]; ?>" alt="" />
                  </div>
                  <div class="product-btns">
                    <button class="btn-cart">
                      Add to Cart
                      <span><i class="fas fa-plus"></i></span>
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
                          echo "<span><i class='fas fa-star'></i></span>";
                        } else {
                          echo "<span><i class='far fa-star'></i></span>";
                        }
                      }
                      ?>
                    </div>
                  </div>
                  <a href="" class="product-name">
                    <?php echo $result_product[1]; ?>
                  </a>
                  <?php echo $result_product[16] !== "Không áp dụng"
                    ? "<p class='product-price product-price-linet'>$$result_product[3]</p>"
                    : ""; ?>
                  <p class="product-price product-price-sale">
                    <?php if ($result_product[16] !== "Không áp dụng") {
                      $sale_percent = $result_product[20];
                      $sale_price =
                        $result_product[3] -
                        $result_product[3] * ($sale_percent / 100);
                      echo "$" . $sale_price;
                    } else {
                      echo "$" . $result_product[3];
                    } ?>
                  </p>
                </div>
                <div class="off-info">
                  <?php if ($result_product[16] === "Không áp dụng") {
                    echo "";
                  } else {
                    $sale_percent = $result_product[20];
                    echo "<h2 class='sm-title'>Sale $sale_percent%</h2>";
                  } ?>
                </div>
              </div>
          <?php }
          } else {
            echo "<h2>No Record Found. </h2>";
          } ?>
        </div>
        <div class="bottom-pagination" id="pagination">
          <ul class="pagination">
            <?php if ($page_id > 1) { ?>
              <li class="item prev-page">
                <a href="category.php?id=<?php echo $category_id; ?>&page=<?php echo $page_id - 1; ?>">
                  <i class="fa-solid fa-chevron-left"></i>
                </a>
              </li>
            <?php } ?>
            <?php for ($i = 1; $i <= $page_total; $i++) { ?>
              <li class="item" id="<?php echo $i; ?>">
                <a href="category.php?id=<?php echo $category_id; ?>&page=<?php echo $i; ?>">
                  <?php echo $i; ?>
                </a>
              </li>
            <?php } ?>
            <?php if ($i > $page_id + 1) { ?>
              <li class="item next-page">
                <a href="category.php?id=<?php echo $category_id; ?>&page=<?php echo $page_id + 1; ?>">
                  <i class="fa-solid fa-chevron-right"></i>
                </a>
              </li>
            <?php }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <?php include "./components/footer.php"; ?>
</body>
<script>
  $(document).ready(function() {
    $('.sub-list').parent('li').addClass('has-child');

  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    function loadProduct(page) {
      $.ajax({
        url: "category.php",
        type: "POST",
        data: {
          page_no: page
        },
        success: function(data) {
          $('#product-data').html(data);
        }

      });
    }

    // Pagination code
    $(document).on("click", "#pagination a", function(e) {

      var page = $(this).attr("id");
      loadTable();
    });

  });
</script>

<script>
  let url_category = location.search.split("&");
  let id = url_category[0].split("=");
  const toggles = document.querySelectorAll('.sidebar ul li');
  for (let i = 0; i < toggles.length; i++) {
    var Li_id = toggles[i].getAttribute('data-id');
    if (Li_id === id[1]) {
      toggles[i].classList.add('active');
      break;
    }
  }

  CurrentPade_id = 1;
  page_id = url_category[1].split("=");
  const Listpage = document.querySelectorAll('.pagination li')
  for (let i = 0; i < Listpage.length; i++) {
    var page_current = Listpage[i].getAttribute('id');
    if (page_current === page_id[1]) {
      Listpage[i].classList.add('current');
      break;
    }
  }
</script>