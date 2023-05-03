<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\controller\inventory_detailController.php";
include_once $filepath . "/helpers/pagination.php";

$inventory_detailController = new InventoryDetailController();
$pag = new Pagination();

if (isset($_GET["enter_id"])) {
  $enter_id = $_GET["enter_id"];
}

if (isset($_GET["deleteid"])) {
  $delete_id = $_GET["deleteid"];
  $delete_inventory_detail = $inventory_detailController->delete_inventory_detail($delete_id);
}

if (isset($_GET["page_detail"])) {
  $page_id = $_GET["page_detail"];
  $pagination_id = $page_id;
}

/*
Tính giá trị của phân trang, 10 sale trên 1 trang
*/
$result_pagination = $inventory_detailController->show_inventory_detail($enter_id);
$inventory_detail_total = mysqli_num_rows($result_pagination);

// Số sản phẩm trên 1 trang
$page_per = 10;
$page_total = ceil($inventory_detail_total / $page_per);

// trang hiện tại
if (isset($page_id)) {
  $current_page = $page_id;
}
// Vị trí hiện tại
if (isset($current_page)) {
  $current_position = ($current_page - 1) * $page_per;
}
if (isset($current_position)) {
  $result_pagination = $inventory_detailController->show_inventory_detail_by_pagination(
    $current_position,
    $page_per,
    $enter_id
  );
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
          if ($result_pagination) {
            while ($result = $result_pagination->fetch_array()) {
          ?>
              <tr>
                <td><?php echo $result[0]; ?></td>
                <td><?php echo $result[1]; ?></td>
                <td><?php echo $result[2]; ?></td>
                <td><?php echo $result[5]; ?></td>
                <td><?php echo $result[3]; ?></td>
                <td><?php echo $result[4]; ?></td>
                <td>
                  <a href="inventory_detail_edit.php?id=<?php echo $result[0]; ?>" class="edit">Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i></a>
                  <a href="?id=11&enter_id=<?php echo $enter_id; ?>&deleteid=<?php echo $result["id"]; ?>" class="delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
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
          <?php if ($pagination_id > 1) { ?>
            <li class="item prev-page">
              <a href="index.php?id=<?php echo $id; ?>&page_detail=<?php echo $pagination_id - 1; ?>&enter_id=<?php echo $enter_id?>">
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
                <a href="index.php?id=<?php echo $id; ?>&page_detail=<?php echo $pagination[$i]; ?>&enter_id=<?php echo $enter_id?>">
                  <?php echo $pagination[$i]; ?>
                </a>
              </li>
          <?php
            }
          }
          ?>
          <?php if ($page_total - 1 > $pagination_id + 1) { ?>
            <li class="item next-page">
              <a href="index.php?id=<?php echo $id; ?>&page_detail=<?php echo $pagination_id + 1; ?>&enter_id=<?php echo $enter_id?>">
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