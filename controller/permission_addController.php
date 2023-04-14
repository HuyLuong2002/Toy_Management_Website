<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/permissionServices.php";

class PermissionAddController
{
    public function insert_permission($data)
    {
      $permissionService = new PermissionServices();
      $result = $permissionService->insert_permission($data);
      return $result;
    }
}
?>