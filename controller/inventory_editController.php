<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/inventoryServices.php";

class InventoryEditController
{
    public function update_inventory($data, $id)
    {
        $inventoryService = new InventoryServices();
        $result = $inventoryService->update_inventory($data, $id);
        return $result;
    }

    public function get_inventory_by_id($id)
    {
        $inventoryService = new InventoryServices();
        $result = $inventoryService->get_inventory_by_id($id);
        return $result;
    }
}
?>