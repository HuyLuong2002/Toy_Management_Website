<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/productServices.php";
class ProductDetailController
{
  // product detail by product id
  public function show_product_detail($product_detail_id)
  {
    $productService = new ProductServices();
    $result = $productService->show_product_detail($product_detail_id);
    return $result;
  }
}
?>
