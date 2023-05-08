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

    public function show_inventory_detail_by_pagination($offset, $limit_per_page, $enter_id)
    {
        $inventoryService = new InventoryServices();
        $result = $inventoryService->show_inventory_detail_by_pagination($offset, $limit_per_page, $enter_id);
        return $result;
    }

    public function insert_inventory_detail($data)
    {
        $inventoryService = new InventoryServices();
        $result = $inventoryService->insert_inventory_detail($data);
        return $result;
    }

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

    public function show_inventory_detail_live_search($input)
    {
        $inventoryService = new InventoryServices();
        $result = $inventoryService->show_inventory_detail_live_search($input);
        return $result;
    }
}
