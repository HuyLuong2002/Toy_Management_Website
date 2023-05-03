<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/categoryServices.php";

class CategoryEditController
{
    public function update_category($data, $files, $id)
    {
        $categoryService = new CategoryServices();
        $result = $categoryService->update_category($data, $files, $id);
        return $result;
    }

    public function show_category_by_id($id)
    {
        $categoryService = new CategoryServices();
        $result = $categoryService->show_category_by_id($id);
        return $result;
    }
} 
?>