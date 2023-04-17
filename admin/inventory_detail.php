<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\controller\inventory_detailController.php";
$inventory_detailController = new InventoryDetailController();
if(isset($_GET["enter_id"]))
{
    $enter_id = $_GET["enter_id"];
}

if(isset($_GET["deleteid"]))
{
  $delete_id = $_GET["deleteid"];
  $delete_inventory_detail = $inventory_detailController->delete_inventory_detail($delete_id);
}
?>

<div class="card">
  <div class="card-header">
    <h3> Detail Receipt List</h3>
    <?php if (isset($delete_inventory_detail)) {
      echo $delete_inventory_detail;
    } ?>
    <button>
      <a href="inventory_detail_add.php">
        Add receipt detail <span class="las la-plus"></span>
      </a>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table width="100%">
        <thead>
          <tr>
            <td>ID</td>
            <td>Enter ID</td>
            <td>Product ID</td>
            <td>Product Name</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php
          $show_inventory_detail = $inventory_detailController->show_inventory_detail($enter_id);
            if($show_inventory_detail)
            {
              while($result = $show_inventory_detail->fetch_array())
              {
          ?>
          <tr>
            <td><?php echo $result[0]; ?></td>
            <td><?php echo $result[1]; ?></td>
            <td><?php echo $result[2]; ?></td>
            <td><?php echo $result[5]; ?></td>
            <td><?php echo $result[3]; ?></td>
            <td><?php echo $result[4]; ?></td>
            <td><a href="inventory_detail_edit.php?id=<?php echo $result[0]; ?>">Edit</a> | <a href="?id=11&enter_id=<?php echo $enter_id; ?>&deleteid=<?php echo $result["id"];?>">Delete</a>
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