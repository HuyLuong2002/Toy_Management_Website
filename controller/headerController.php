<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/productsController.php";
$productsController = new ProductsController();
if (isset($_POST["input"]) && isset($_POST["searchkey"])) {
  $input = $_POST["input"];
  $searchkey = $_POST["searchkey"];
  switch ($searchkey) {
    case 0:
      $show_product_live_search = $productsController->show_product_live_search(
        $input
      );
      break;
    case 1:
      $show_product_live_search = $productsController->show_product_live_search_category(
        $input
      );
      break;
    case 2:
      $show_product_live_search = $productsController->show_product_live_search_price(
        $input
      );
      break;
    case 3:
      $show_product_live_search = $productsController->show_product_live_search_name(
        $input
      );
      break;

    case 4:
      $show_product_live_search = $productsController->show_product_live_search_rating(
        $input
      );
      break;
  }
}
?>
<?php if (isset($show_product_live_search)) {
  if ($show_product_live_search) { ?>
              <?php while (
                $result = $show_product_live_search->fetch_array()
              ) { ?>
            <div class="product-search">
                <span>&times</span>
                <div class="show-product-search">
                    <img src="<?php echo "/admin/uploads/" .
                      $result["image"]; ?>" alt="">
                    <div class="sub-product">
                        
                        <h4><a href="../product_detail.php?id=<?php echo $result[0]; ?>"><?php echo $result[1]; ?></a></h4>
                        <p><?php echo $result["description"]; ?></p>
                    </div>
                </div>
            </div>
            <?php }
            } else { ?>
            <div class="product-search">
                <span>No Data Found</span>
            </div>
            <?php
            }
            ?>
<?php  
} ?>
