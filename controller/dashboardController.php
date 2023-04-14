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
}

?>