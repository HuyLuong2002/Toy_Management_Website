<?php
    $filepath = realpath(dirname(__DIR__));
    include_once $filepath . "\services\detail_ordersServices.php";
    class DetailOrderController
    {
        public function delete_detail_orders($id)
        {
            $detail_ordersServices = new DetailOrderServices();
            $result = $detail_ordersServices->delete_detail_orders($id);
            return $result;
        }
    }
?>