<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/inventoryServices.php";

class InventoryDetailEditController
{
    public function get_detail_enter_by_id($id)
    {
        $inventoryService = new InventoryServices();
        $result = $inventoryService->get_detail_inventory_by_id($id);
        return $result;
    }

    public function update_inventory_detail($data, $id)
    {
        $inventoryService = new InventoryServices();
        $result = $inventoryService->update_inventory_detail($data, $id);
        return $result;
    }
}

?>