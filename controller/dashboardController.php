<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\services\dashboardServices.php";

class DashboardController
{
    public function show_statistic_product()
    {
        $dashboardServices = new DashboardServices();
        $result = $dashboardServices->show_statistic_product();
        return $result;
    }

    public function show_statistic_order()
    {
        $dashboardServices = new DashboardServices();
        $result = $dashboardServices->show_statistic_orders();
        return $result;
    }

    public function show_statistic_customer()
    {
        $dashboardServices = new DashboardServices();
        $result = $dashboardServices->show_statistic_customer();
        return $result;
    }

    public function show_statistic_income()
    {
        $dashboardServices = new DashboardServices();
        $order_list = $dashboardServices->show_orders();
        $sum_income = 0;
        while($result = $order_list->fetch_assoc())
        {
            $sum_income += (int) $result["total_price"];
        }
        return $sum_income;
    }
}

?>