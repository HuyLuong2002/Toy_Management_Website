<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/permissionServices.php";

class PermissionController
{
  public function show_permission()
  {
    $permissionService = new PermissionServices();
    $result = $permissionService->show_permission();
    return $result;
  }

  public function delete_permission($id)
  {
    $permissionService = new PermissionServices();
    $result = $permissionService->delete_permission($id);
    return $result;
  }

  //live search for admin
  public function show_permission_live_search($input)
  {
    $permissionService = new PermissionServices();
    $result = $permissionService->show_permission_live_search($input);
    return $result;
  }
}
?>
