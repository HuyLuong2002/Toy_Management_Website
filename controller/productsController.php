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

  public function show_slider_product()
  {
    $productService = new ProductServices();
    $result = $productService->show_slider_product();
    return $result;
  }

  //live search for admin
  public function show_product_live_search($input)
  {
    $productService = new ProductServices();
    $result = $productService->show_product_live_search($input);
    return $result;
  }

  public function show_product_live_search_category($input)
  {
    $productService = new ProductServices();
    $result = $productService->show_product_live_search_category($input);
    return $result;
  }

  public function show_product_live_search_price($input)
  {
    $productService = new ProductServices();
    $result = $productService->show_product_live_search_price($input);
    return $result;
  }

  public function show_product_live_search_price_lower_500()
  {
    $productService = new ProductServices();
    $result = $productService->show_product_live_search_price_lower_500();
    return $result;
  }

  public function show_product_live_search_price_from_500_to_1000()
  {
    $productService = new ProductServices();
    $result = $productService->show_product_live_search_price_from_500_to_1000();
    return $result;
  }

  public function show_product_live_search_price_from_1000_to_2000()
  {
    $productService = new ProductServices();
    $result = $productService->show_product_live_search_price_from_1000_to_2000();
    return $result;
  }

  public function show_product_live_search_price_greater_2000()
  {
    $productService = new ProductServices();
    $result = $productService->show_product_live_search_price_greater_2000();
    return $result;
  }
  public function show_product_live_search_rating_1()
  {
    $productService = new ProductServices();
    $result = $productService->show_product_live_search_rating_1();
    return $result;
  }

  public function show_product_live_search_rating_2()
  {
    $productService = new ProductServices();
    $result = $productService->show_product_live_search_rating_2();
    return $result;
  }

  public function show_product_live_search_rating_3()
  {
    $productService = new ProductServices();
    $result = $productService->show_product_live_search_rating_3();
    return $result;
  }

  public function show_product_live_search_rating_4()
  {
    $productService = new ProductServices();
    $result = $productService->show_product_live_search_rating_4();
    return $result;
  }

  public function show_product_live_search_rating_5()
  {
    $productService = new ProductServices();
    $result = $productService->show_product_live_search_rating_5();
    return $result;
  }

  public function show_product_live_search_category_id($id)
  {
    if($id == 41) $id = 2;
    else if($id == 42) $id = 1;
    $productService = new ProductServices();
    $result = $productService->show_product_live_search_category_id($id);
    return $result;
  }

  public function show_product_live_search_name($input)
  {
    $productService = new ProductServices();
    $result = $productService->show_product_live_search_name($input);
    return $result;
  }

  public function show_product_live_search_rating($input)
  {
    $productService = new ProductServices();
    $result = $productService->show_product_live_search_rating($input);
    return $result;
  }

  public function delete_product($id)
  {
    $productService = new ProductServices();
    $result = $productService->delete_product($id);
    return $result;
  }

  public function show_product_by_category_id($category)
  {
    $productService = new ProductServices();
    $result = $productService->show_product_by_category_id($category);
    return $result;
  }

  public function show_product_by_category_id_unique($id)
  {
    $productService = new ProductServices();
    $result = $productService->show_product_by_category_id_unique($id);
    return $result;
  }

  public function show_product_for_pagination()
  {
    $productService = new ProductServices();
    $result = $productService->show_product_for_pagination();
    return $result;
  }

  public function show_product_sort($sortKey)
  {
    $productService = new ProductServices();
    $result = $productService->show_product_sort($sortKey);
    return $result;
  }

  public function show_product_by_panigation_admin($offset, $limit_per_page)
  {
    $productService = new ProductServices();
    $result = $productService->show_product_by_panigation_admin(
      $offset,
      $limit_per_page
    );
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

  public function show_product_receipt()
  {
    $productService = new ProductServices();
    $result = $productService->show_product_receipt();
    return $result;
  }

  //list product by category id

  //list product by category id have off and limit
  public function show_product_by_category_panigation(
    $category_id,
    $offset,
    $limit_per_page
  ) {
    $productService = new ProductServices();
    $result = $productService->show_product_by_category_panigation(
      $category_id,
      $offset,
      $limit_per_page
    );
    return $result;
  }

  public function insert_product($data)
  {
    $productService = new ProductServices();
    $result = $productService->insert_product($data);
    return $result;
  }

  public function update_product($data, $id)
  {
    $productService = new ProductServices();
    $result = $productService->update_product($data, $id);
    return $result;
  }

  public function get_product_by_id($id)
  {
    $productService = new ProductServices();
    $result = $productService->get_product_by_id($id);
    return $result;
  }

  public function show_product_detail($product_detail_id)
  {
    $productService = new ProductServices();
    $result = $productService->show_product_detail($product_detail_id);
    return $result;
  }
}
