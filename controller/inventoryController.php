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

    public function show_inventory_by_pagination($offset, $limit_per_page){
        $inventoryServices = new InventoryServices();
        $result = $inventoryServices->show_inventory_by_pagination($offset, $limit_per_page);
        return $result;
    }

    public function insert_inventory($data)
    {
        $inventoryServices = new InventoryServices();
        $result = $inventoryServices->insert_inventory($data);
        return $result;
    }

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