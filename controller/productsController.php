<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/productServices.php";
class ProductsController
{
    public function show_product_user()
    {
        $productService = new ProductServices();
        $result = $productService->show_product_user();
        return $result;
    }

    //live search for admin
    public function show_product_live_search($input)
    {
        $productService = new ProductServices();
        $result = $productService->show_product_live_search($input);
        return $result;
    }

    public function delete_product($id)
    {
        $productService = new ProductServices();
        $result = $productService->delete_product($id);
        return $result;
    }

    public function show_product_for_pagination()
    {
        $productService = new ProductServices();
        $result = $productService->show_product_for_pagination();
        return $result;
    }

    public function show_product_by_panigation_admin(
        $offset,
        $limit_per_page
      ) {
        $productService = new ProductServices();
        $result = $productService->show_product_for_pagination();
        return $result;
      }

    public function update_product_highlight($highlight, $id)
    {
        $productService = new ProductServices();
        $result = $productService->update_product_highlight($highlight, $id);
        return $result;
    }

    public function show_product()
    {
        $productService = new ProductServices();
        $result = $productService->show_product();
        return $result;
    }

      //list product by category id
  public function show_product_by_category_id($category_id)
  {
    $productService = new ProductServices();
    $result = $productService->show_product_by_category_id($category_id);
    return $result;
  }

    //list product by category id have off and limit
    public function show_product_by_category_panigation(
      $category_id,
      $offset,
      $limit_per_page
    ) {
      $productService = new ProductServices();
      $result = $productService->show_product_by_category_panigation($category_id, $offset, $limit_per_page);
      return $result;
    }

    
  public function pageNumber($page_total, $max, $current){
    $half = ceil($max / 2);
    $to = $max;

    if ($current + $half >= $page_total)
      $to = $page_total;
    else if ($current > $half)
      $to = $current + $half;

      $from = $to - $max;
      $result = array();

      for ($i = 1; $i <= $max; $i++){
        $result[$i] = ($i) + $from;
      }
      return $result;
  }
}

?>