<?php
    $filepath = realpath(dirname(__DIR__));
    include_once $filepath . "\services\ordersServices.php";

    class OrderController
    {
        public function show_orders_live_search($input)
        {
            $orderService = new OrderServices();
            $result = $orderService->show_orders_live_search($input);
            return $result;
        }

        public function show_orders_to_export($id)
        {
            $orderService = new OrderServices();
            $result = $orderService->show_orders_to_export($id);
            return $result;
        }

        public function delete_orders($id)
        {
            $orderService = new OrderServices();
            $result = $orderService->delete_orders($id);
            return $result;
        }

        public function show_orders_user()
        {
            $orderService = new OrderServices();
            $result = $orderService->show_orders_user();
            return $result;
        }

        public function show_order_by_pagination($offset, $limit_per_page)
        {
            $orderService = new OrderServices();
            $result = $orderService->show_order_by_pagination($offset, $limit_per_page);
            return $result;
        }
    }
?>