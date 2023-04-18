<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/saleServices.php";

class SaleAddController{
    public function insert_sale($data){
        $saleService = new SaleServices();
        $result = $saleService->insert_sale($data);
        return $result;
    }
}
?>