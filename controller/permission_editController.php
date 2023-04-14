<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/permissionServices.php";

class PermissionEditController
{
    public function update_permission($data, $id)
    {
        $permissionService = new PermissionServices();
        $result = $permissionService->update_permission($data, $id);
        return $result;
    }

    public function get_permission_by_id($id)
    {
        $permissionService = new PermissionServices();
        $result = $permissionService->get_permission_by_id($id);
        return $result;
    }
}
?>