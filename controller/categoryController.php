<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/categoryServices.php";
class CategoryController
{
  public function show_category()
  {
    $categoryService = new CategoryServices();
    $result = $categoryService->show_category();
    return $result;
  }

  public function show_category_by_id($category_id)
  {
    $categoryService = new CategoryServices();
    $result = $categoryService->show_category_by_id($category_id);
    return $result;
  }
  public function show_category_live_search($input)
  {
    $categoryService = new CategoryServices();
    $result = $categoryService->show_category_live_search($input);
    return $result;
  }

  public function update_category($data, $id)
  {
    $categoryService = new CategoryServices();
    $result = $categoryService->update_category($data, $id);
    return $result;
  }

  public function insert_category($data)
  {
    $categoryService = new CategoryServices();
    $result = $categoryService->insert_category($data);
    return $result;
  }

  public function delete_category($id)
  {
    $categoryService = new CategoryServices();
    $result = $categoryService->delete_category($id);
    return $result;
  }
}
