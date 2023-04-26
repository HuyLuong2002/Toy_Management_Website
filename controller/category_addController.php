<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/categoryServices.php";

class CategoryAddController {
    public function insert_category($data, $files)
    {
        $categoryService = new CategoryServices();
        $result = $categoryService->insert_category($data, $files);
        return $result;
    }
}
?>