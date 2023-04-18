<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/saleServices.php";

class SaleEditController{
    public function update_sale($data, $id){
        $saleService = new SaleServices();
        $result = $saleService->update_sale($data, $id);
        return $result;
    }

    public function get_sale_by_id($id){
        $saleService = new SaleServices();
        $result = $saleService->get_sale_by_id($id);
        return $result;
    }
}
?>