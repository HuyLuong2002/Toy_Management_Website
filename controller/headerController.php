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
    case 21:
      $show_product_live_search = $productsController->show_product_live_search_price_lower_500();
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
} elseif (isset($_POST["searchkey"])) {
  $searchkey = $_POST["searchkey"];
  switch ($searchkey) {
    case 21:
      $show_product_live_search = $productsController->show_product_live_search_price_lower_500();
      break;
    case 22:
      $show_product_live_search = $productsController->show_product_live_search_price_from_500_to_1000();
      break;
    case 23:
      $show_product_live_search = $productsController->show_product_live_search_price_from_1000_to_2000();
      break;
    case 24:
      $show_product_live_search = $productsController->show_product_live_search_price_greater_2000();
      break;
    case 31:
      $show_product_live_search = $productsController->show_product_live_search_rating_1();
      break;
    case 32:
      $show_product_live_search = $productsController->show_product_live_search_rating_2();
      break;
    case 33:
      $show_product_live_search = $productsController->show_product_live_search_rating_3();
      break;
    case 34:
      $show_product_live_search = $productsController->show_product_live_search_rating_4();
      break;
    case 35:
      $show_product_live_search = $productsController->show_product_live_search_rating_5();
      break;
    case 41:
      $show_product_live_search = $productsController->show_product_live_search_category_id($searchkey);
      break;
    case 42:
      $show_product_live_search = $productsController->show_product_live_search_category_id($searchkey);
      break;
  }
}
?>
<?php if (isset($show_product_live_search)) {
  if ($show_product_live_search) { ?>
    <?php while ($result = $show_product_live_search->fetch_array()) { ?>
      <div class="product-search">
        <div class="show-product-search">
          <img src="<?php echo "/admin/uploads/" . $result["image"]; ?>" alt="">
          <div class="sub-product">

            <h4><a href="../product_detail.php?id=<?php echo $result[0]; ?>"><?php echo $result[1]; ?></a></h4>
            <?php echo $result["description"]; ?>
          </div>
        </div>
      </div>
    <?php }} else { ?>
    <div class="product-search">
      <span>No Data Found</span>
    </div>
  <?php } ?>
<?php
} ?>
