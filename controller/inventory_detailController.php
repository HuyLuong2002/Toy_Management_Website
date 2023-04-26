<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/inventoryServices.php";

class InventoryDetailController
{
    public function show_inventory_detail($enter_id)
    {
        $inventoryService = new InventoryServices();
        $result = $inventoryService->show_inventory_detail($enter_id);
        return $result;
        
    }

    public function delete_inventory_detail($id)
    {
        $inventoryService = new InventoryServices();
        $result = $inventoryService->delete_inventory_detail($id);
        return $result;
    }

}
?>