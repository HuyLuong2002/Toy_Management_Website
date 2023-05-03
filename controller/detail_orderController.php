<?php
    $filepath = realpath(dirname(__DIR__));
    include_once $filepath . "\services\detail_ordersServices.php";

    class DetailOrderController
    {
        public function delete_detail_order($id)
        {
            $detail_orderservice = new DetailOrderServices();
            $result = $detail_orderservice->delete_detail_orders($id);
            return $result;
        }

        public function show_detail_order()
        {
            $detail_orderservice = new DetailOrderServices();
            $result = $detail_orderservice->show_detail_order();
            return $result;
        }

        public function show_detail_order_to_export($id)
        {
            $detail_orderservice = new DetailOrderServices();
            $result = $detail_orderservice->show_detail_order_to_export($id);
            return $result;
        }
    }
?>