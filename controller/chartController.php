<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/chartServices.php";

class ChartController 
{

    public function show_best_selling_products($startDate, $endDate)
    {
        $chartService = new ChartServices();
        $result = $chartService->show_best_selling_products($startDate, $endDate);
        return $result;
    }

    public function show_revenue_quarter($year)
    {
        $chartService = new ChartServices();
        $result = $chartService->show_revenue_quarter($year);
        return $result;
    }

    public function show_statistic_order()
    {
        $chartService = new ChartServices();
        $result = $chartService->show_statistic_order();
        return $result;
    }

    // compare revenue 2 year by month
    public function show_statistic_revenue_by_month($year1, $year2)
    {
        if($year1 > $year2)
        {
            $tmp = $year1;
            $year1 = $year2;
            $year2 = $tmp;
        }
        $chartService = new ChartServices();
        $result = $chartService->show_statistic_revenue_by_month($year1, $year2);
        return $result;
    }
}
?>