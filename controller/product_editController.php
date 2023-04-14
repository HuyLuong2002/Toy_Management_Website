<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/productServices.php";

class ProductEditController
{

    public function update_product($data, $files, $id)
    {
        $productService = new ProductServices();
        $result = $productService->update_product($data, $files, $id);
        return $result;
    }

    public function get_product_by_id($id)
    {
        $productService = new ProductServices();
        $result = $productService->get_product_by_id($id);
        return $result;
    }
}

?>