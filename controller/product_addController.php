<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/productServices.php";
class ProductAddController
{

    public function insert_product($data, $files)
    {
        $productService = new ProductServices();
        $result = $productService->insert_product($data, $files);
        return $result;
    }
}

?>