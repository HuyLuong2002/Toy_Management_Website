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
}
?>