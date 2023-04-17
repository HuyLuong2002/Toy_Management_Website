<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/chartServices.php";

class ChartController 
{
    public function show_revenue_quarter($year)
    {
        $chartService = new ChartServices();
        $result = $chartService->show_revenue_quarter(2023);
        return $result;

    }
}
?>