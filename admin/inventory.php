<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\controller\inventoryController.php";
include_once $filepath . "/helpers/pagination.php";

$inventoryController = new InventoryController();
$pag = new Pagination();

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["deleteid"])) {
  $delete_id = $_GET["deleteid"];
  $delete_inventory = $inventoryController->delete_inventory($delete_id);
}

if (isset($_GET["page"])) {
  $page_id = $_GET["page"];
  $pagination_id = $page_id;
}

/*
Tính giá trị của phân trang, 10 sale trên 1 trang
*/
$result_pagination =  $inventoryController->show_inventory();
$inventory_total = mysqli_num_rows($result_pagination);

// Số sản phẩm trên 1 trang
$page_total = ceil($inventory_total / 10);

// trang hiện tại
if (isset($page_id)) {
  $current_page = $page_id;
}
// Vị trí hiện tại
if (isset($current_page)) {
  $current_position = ($current_page - 1) * 10;
}
if (isset($current_position)) {
  $result_pagination = $inventoryController->show_inventory_by_pagination(
    $current_position,
    10
  );
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
        <tbody id="inventory-data">
          <?php
          if (isset($result_pagination)) {
            while ($result = $result_pagination->fetch_array()) {
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
                <td>
                  <a href="inventory_edit.php?id=<?php echo $result[0]; ?>" class="Edit">Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i></a><br>
                  <a href="?id=4&page=<?php echo $page_id?>&deleteid=<?php echo $result["id"]; ?>" class="Delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
                  <a href="?id=11&page_detail=<?php echo $page_id?>&enter_id=<?php echo $result[0]; ?>" class="Detail">Details <i class="fa-solid fa-circle-info" style="color: #03a945;"></i></a>
                <td>
              </tr>
          <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>

    <?php if (empty($_POST["input"])) { ?>
      <div class="bottom-pagination" id="pagination">
        <ul class="pagination">
          <?php if ($pagination_id > 1 && $page_total > 4) { ?>
            <li class="item prev-page">
              <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $pagination_id - 1; ?>">
                <i class="fa-solid fa-chevron-left"></i>
              </a>
            </li>
          <?php } ?>
          <?php
          $pagination = $pag->pageNumber($page_total, 4, $pagination_id);
          $length = count($pagination);
          for ($i = 1; $i <= $length; $i++) {
            if ($pagination[$i] > 0) {
              if ($pagination[$i] == $pagination_id) {
                $current = "current";
              } else {
                $current = "";
              } ?>
              <li class="item <?php echo $current; ?>" id="<?php echo $pagination[$i]; ?>">
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $pagination[$i]; ?>">
                  <?php echo $pagination[$i]; ?>
                </a>
              </li>
          <?php
            }
          }
          ?>
          <?php if ($page_total - 1 > $pagination_id + 1 && $page_total > 4) { ?>
            <li class="item next-page">
              <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $pagination_id +
                                                              1; ?>">
                <i class="fa-solid fa-chevron-right"></i>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
    <?php
    }
    ?>
  </div>
</div>