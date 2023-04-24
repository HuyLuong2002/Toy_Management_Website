<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\controller\permissionController.php";

$permissionController = new PermissionController();

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_permission_live_search = $permissionController->show_permission_live_search($input);
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["deleteid"])) {
  $delete_id = $_GET["deleteid"];
  $delete_permission = $permissionController->delete_permission($delete_id);
}
?>


<div class="card" id="searchresultpermission">
  <div class="card-header">
    <h3>Permission List</h3>
    <?php if (isset($delete_permission)) {
      echo $delete_permission;
    } ?>
    <button>
      <a href="permission_add.php">
        Add permission for account <span class="las la-plus"></span>
      </a>
    </button>
    <button>
      <a href="permission_add.php">
        Add permission <span class="las la-plus"></span>
      </a>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table width="100%">
        <thead>
          <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php
          $result_permission = $permissionController->show_permission();
          if (isset($result_permission)) {
            while ($result = $result_permission->fetch_assoc()) {
          ?>
              <tr>
                <td><?php echo $result["id"]; ?></td>
                <td><?php echo $result["name"]; ?></td>
                <td>
                  <a href="permission_edit.php?id=<?php echo $result["id"]; ?>" class="edit">Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i></a>
                  <a href="?id=6&deleteid=<?php echo $result["id"]; ?>" class="delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
                <td>
              </tr>
          <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

