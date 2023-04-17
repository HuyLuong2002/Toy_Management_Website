<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/inventoryServices.php";

class InventoryAddController
{
    public function insert_inventory($data)
    {
        $inventoryServices = new InventoryServices();
        $result = $inventoryServices->insert_inventory($data);
        return $result;
    }
}
?>