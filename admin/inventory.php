<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\controller\inventoryController.php";
$inventoryController = new InventoryController();


if(isset($_GET["deleteid"]))
{
  $delete_id = $_GET["deleteid"];
  $delete_inventory = $inventoryController->delete_inventory($delete_id);
}
?>

<div class="card">
  <div class="card-header">
    <h3>Receipt List</h3>
    <?php if (isset($delete_inventory)) {
      echo $delete_inventory;
    } ?>
    <button>
      <a href="inventory_add.php">
        Add receipt <span class="las la-plus"></span>
      </a>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table width="100%">
        <thead>
          <tr>
            <td>ID</td>
            <td>Enter Date</td>
            <td>Total Quantity</td>
            <td>Total Price</td>
            <td>Provider</td>
            <td>Enter Employee</td>
            <td>Status</td>
            <td>Create Date</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php
          $show_inventory = $inventoryController->show_inventory();
            if(isset($show_inventory))
            {
              while($result = $show_inventory->fetch_array())
              {
          ?>
          <tr>
            <td><?php echo $result[0]; ?></td>
            <td><?php echo $result[1]; ?></td>
            <td><?php echo $result[2]; ?></td>
            <td><?php echo $result[3]; ?></td>
            <td><?php echo $result[9]; ?></td>
            <td><?php echo $result[10] . " " . $result[11]; ?></td>
            <td><?php echo $result[6] == 1 ?  "Đã giao" : "Đang giao hàng"; ?></td>
            <td><?php echo $result[7]; ?></td>
            <td><a href="inventory_edit.php?id=<?php echo $result[0]; ?>">Edit</a> | <a href="?id=4&deleteid=<?php echo $result["id"];?>">Delete</a> | <a href="?id=11&enter_id=<?php echo $result[0]; ?>">Details</a>
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