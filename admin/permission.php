<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\classes\permission.php";

$permission = new Permission();
$result_permission = $permission->show_permission();

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if(isset($_GET["deleteid"]))
{
  $delete_id = $_GET["deleteid"];
  $delete_permission = $permission->delete_permission($delete_id);
}
?>


<div class="card">
  <div class="card-header">
    <h3>Permission List</h3>
    <?php if (isset($delete_permission)) {
      echo $delete_permission;
    } ?>
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
              if(isset($result_permission))
              {
                while($result = $result_permission->fetch_assoc())
                {
            ?>
          <tr>
            <td><?php echo $result["id"]; ?></td>
            <td><?php echo $result["name"]; ?></td>
            <td><a href="permission_edit.php?id=<?php echo $result["id"];?>">Edit</a> | <a href="?id=<?php echo $id; ?>&deleteid=<?php echo $result["id"];?>">Delete</a>
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