<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/saleServices.php";
class SaleController
{
    public function show_sale()
    {
      $saleService = new SaleServices();
      $result = $saleService->show_sale();
      return $result;
    }

    // live search sale for admin 
    public function show_sale_live_search($input){
      $saleService = new SaleServices();
      $result = $saleService->show_sale_live_search($input);
      return $result;
    }

    public function delete_sale($id){
      $saleService = new SaleServices();
      $result = $saleService->delete_sale($id);
      return $result; 
    }

    public function show_sale_by_pagination($offset, $limit_per_page){
      $saleService = new SaleServices();
      $result = $saleService->show_sale_by_pagination($offset, $limit_per_page);
      return $result;
    }
}
?>