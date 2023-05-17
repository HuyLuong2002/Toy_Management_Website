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

  public function check_permission($permissionName)
  {
    $permissionService = new PermissionServices();
    $result = $permissionService->check_permission($permissionName);
    return $result;
  }

  public function insert_permission($data)
  {
    $permissionService = new PermissionServices();
    $result = $permissionService->insert_permission($data);
    return $result;
  }

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

  public function delete_permission($id)
  {
    $permissionService = new PermissionServices();
    $get_permission = $permissionService->get_permission_by_id($id);
    $result = $get_permission->fetch_array();
    if ($result[1] == "Admin") {
      $alert = "<span class='error'>Can Not Delete Admin</span>";
      return $alert;
    } else {
      $result_delete = $permissionService->delete_permission($id);
      $alert = $result_delete;
      return $alert;
    }
    // return $result;
  }

  //live search for admin
  public function show_permission_live_search($input)
  {
    $permissionService = new PermissionServices();
    $result = $permissionService->show_permission_live_search($input);
    return $result;
  }

  public function show_permission_by_pagination($offset, $limit_per_page)
  {
    $permissionService = new PermissionServices();
    $result = $permissionService->show_permission_by_pagination($offset, $limit_per_page);
    return $result;
  }
}
