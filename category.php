<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath .
  "\Toy_Management_Website\controller\categoryController.php";
include_once $filepath . "\controller\productsController.php";
include_once $filepath . "/helpers/pagination.php";

$pag = new Pagination();
$categoryController = new CategoryController();
$productsController = new ProductsController();
if (isset($_GET["id"])) {
  $category_id = $_GET["id"];
  settype($category_id, "int");
}
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
          $show_category_by_id = $categoryController->show_category_by_id(
            $category_id
          );
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
            $show_category = $categoryController->show_category();
            if ($show_category) {
              while ($result = $show_category->fetch_assoc()) {
                if ($category_id == $result["id"]) {
                  $active = "active";
                } else {
                  $active = "";
                } ?>
                <li data-id="<?php echo $result["id"]; ?>" class="<?php echo $active; ?>">
                  <a href="category.php?id=<?php echo $result["id"]; ?>">
                    <?php echo $result["name"]; ?>
                  </a>
                </li>
            <?php
              }
            }
            ?>
          </ul>
        </div>
      </div>

      <input type="hidden" value="<?php echo $category_id ?>" id="category_id">
      <div class="list-product" id="product-data">

      </div>
    </div>
  </div>

  <?php include "./components/footer.php"; ?>

  <script src="./js/newWishList.js"></script>
  <script src="./js/cartclick.js"></script>
</body>
<script>
  $(document).ready(function() {
    $('.sub-list').parent('li').addClass('has-child');

  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    loadProduct();

    function loadProduct(page) {
      var category_id = $('#category_id').val();
      console.log(category_id);
      $.ajax({
        url: "paginationcategory.php",
        type: "POST",
        data: {
          page: page,
          category_id: category_id,
        },
        success: function(data) {
          $('#product-data').html(data);
        }

      });
    }

    // Pagination code
    $(document).on("click", "#pagination li", function(e) {
      e.preventDefault();
      var page = $(this).attr("id");
      loadProduct(page);
    });

  });
</script>