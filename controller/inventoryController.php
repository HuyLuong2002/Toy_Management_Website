<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/inventoryServices.php";

class InventoryController
{
    public function show_inventory()
    {
        $inventoryServices = new InventoryServices();
        $result = $inventoryServices->show_inventory();
        return $result;
    }

    public function delete_inventory($id) {
        $inventoryServices = new InventoryServices();
        $result = $inventoryServices->delete_inventory($id);
        return $result;
    }
}
?>