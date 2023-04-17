<?php

$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/inventoryServices.php";

class InventoryDetailAddController
{
    public function insert_inventory_detail($data) {
        $inventoryService = new InventoryServices();
        $result = $inventoryService->insert_inventory_detail($data);
        return $result;
    }
}
?>