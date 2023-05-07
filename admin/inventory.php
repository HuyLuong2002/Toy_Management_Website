<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\controller\inventoryController.php";
include_once $filepath . "/controller/providersController.php";
include_once $filepath . "/helpers/pagination.php";

$inventoryController = new InventoryController();
$pag = new Pagination();

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["inventory_id"])) {
  $show_inventory = $inventoryController->get_inventory_by_id($_GET["inventory_id"]);
  if (mysqli_num_rows($show_inventory) == 1) {
    $sale = mysqli_fetch_array($show_inventory);

    $res = [
      'status' => 200,
      'message' => 'sale fetch successful by id',
      'data' => $sale
    ];
    echo json_encode($res);
    return;
  } else {
    $res = [
      'status' => 404,
      'message' => 'sale Id Not Found'
    ];
    echo json_encode($res);
    return;
  }
}

if (isset($_POST["delete-btn"])) {
  $delete_id = $_POST["delete_id"];
  $deleteInventory = $inventoryController->delete_inventory($delete_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add-btn"])) {
  $insertInventory = $inventoryController->insert_inventory($_POST);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit-btn"])) {
  $edit_id = $_POST["edit_id"];
  $updateInventory = $inventoryController->update_inventory($_POST, $edit_id);
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
    <div class="bg-modal-box"></div>
    <h3>Receipt List</h3>
    <div class="notification">
      <?php
      if (isset($deleteInventory)) {
        echo $deleteInventory;
      }
      if (isset($insertInventory)) {
        echo $insertInventory;
      }
      if (isset($updateInventory)) {
        echo $updateInventory;
      }
      ?>
    </div>
    <button type="button" class="modal-btn-add" onclick="AddActive()">
      <p>
        Add sale <span class="las la-plus"></span>
      </p>
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
                  <!-- <a href="inventory_edit.php?id=<?php echo $result[0]; ?>" class="Edit">Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i></a><br>
                  <a href="?id=4&page=<?php echo $page_id ?>&deleteid=<?php echo $result["id"]; ?>" class="Delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a> -->
                  <div class="action-btn-group">
                    <div class="action-btn-edit" id="action-btn-edit-<?php echo $result[0] ?>">
                      <button class="modal-btn-edit" type="button" value="<?php echo $result[0] ?>" onclick="EditActive(<?php echo $result[0] ?>)">
                        Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i>
                      </button>
                    </div>
                    <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0] ?>">
                      <button class="modal-btn-delete" type="button" value="<?php echo $result[0] ?>" onclick="DeleteActive(<?php echo $result[0] ?>)">
                        Delete<i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                      </button>
                    </div>
                    <a href="?id=11&page_detail=<?php echo $page_id ?>&enter_id=<?php echo $result[0]; ?>" class="Detail">Details <i class="fa-solid fa-circle-info" style="color: #03a945;"></i></a>
                  </div>
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

  <!-- Modal delete -->
  <form class="modal-container-delete" id="modal-container-delete" method="post" enctype="multipart/form-data">
    <input type="hidden" name="delete_id" class="delete_id">
    <div class="modal-delete-title">
      Are you sure want to delete?
    </div>
    <div class="modal-delete-btn-group">
      <button class="modal-delete-btn delete-btn" name="delete-btn">Delete</button>
      <button type="button" class="modal-delete-btn delete-btn-cancel" id="delete-btn-cancel" onclick="cancelDeleteModal()">
        <span>Cancel</span>
      </button>
    </div>
  </form>
  <!-- modal delete end -->

  <!-- modal edit  -->
  <form class="modal-container-edit" id="modal-container-edit" method="post" enctype="multipart/form-data">
    <div class="modal-container-edit-close" onclick="closeCurdEditModal()"><span><i class="fa-solid fa-circle-xmark"></i></span></div>
    <input type="hidden" id="edit_id" name="edit_id" class="edit_id">
    <div class="modal-edit-info">
      <div class="modal-edit-info-item">
        <label for="name">Name</label>
        <input type="text" id="name_edit" name="name_edit" required value="">
      </div>

      <div class="modal-edit-info-item">
        <label for="start">Start date</label>
        <input type="date" id="start_edit" name="start_edit" required value="">
      </div>

      <div class="modal-edit-info-item">
        <label for="end">End date</label>
        <input type="date" id="end_edit" name="end_edit" required value="">
      </div>

      <div class="modal-edit-info-item">
        <label for="percent">Percent</label>
        <input type="number" id="percent_edit" name="percent_edit" required value="">
      </div>

      <div class="modal-edit-info-item">
        <label for="status">Status</label>
        <select class="modal-edit-input-select" id="status_edit" name="status_edit" required>
          <option value="">Select status</option>
          <option value="1">Còn áp dụng</option>
          <option value="0">Hết áp dụng</option>
        </select>
      </div>
    </div>

    <input class="modal-edit-btn" name="edit-btn" type="submit" value="Save">
  </form>
  <!-- modal edit end -->

  <!-- modal add  -->
  <form class="modal-container-add" id="modal-container-add" method="post" enctype="multipart/form-data">
    <div class="modal-container-add-close" onclick="closeCurdAddModal()"><span><i class="fa-solid fa-circle-xmark"></i></span></div>
    <div class="modal-add-info">
      <div class="modal-add-info-item">
        <label for="enter-date_add">Enter Date</label>
        <input type="date" id="enter-date_add" name="enter-date_add" required>
      </div>

      <div class="modal-add-info-item">
        <label for="total-quantity_add">Total Quantity</label>
        <input type="text" id="total-quantity_add" name="total-quantity_add" required>
      </div>

      <div class="modal-add-info-item">
        <label for="total-price_add">Total Price</label>
        <input type="text" id="total-price_add" name="total-price_add" required>
      </div>

      <div class="modal-add-info-item">
        <label for="percent">Percent</label>
        <input type="number" id="percent_add" name="percent_add" required value="">
      </div>

      <div class="modal-add-info-item">
        <label for="provider">Provider</label>
        <select class="modal-add-input-select" id="provider_add" name="provider_add" required>
          <option value="">Select provider</option>
          <?php
          $providerController = new ProviderController();
          $show_provider = $providerController->show_provider_user();
          if ($show_provider) {
            $i = 0;
            while ($result = $show_provider->fetch_assoc()) {
              $i++; ?>
              <option value="<?php echo $result["id"]; ?>"><?php echo $result["name"]; ?></option>
          <?php
            }
          }
          ?>
        </select>
      </div>

      <div class="modal-add-info-item">
        <label for="provider">Provider</label>
        <select class="modal-add-input-select" id="status_add" name="status_add" required>
          <option value="">Select status</option>
          <option value="1">Còn áp dụng</option>
          <option value="0">Hết áp dụng</option>
        </select>
      </div>
    </div>

    <input onclick="" class="modal-add-btn" name="add-btn" type="submit" value="Save">
  </form>
  <!-- modal add end -->
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('.modal-btn-delete').click(function(e) {
      e.preventDefault();
      var delete_id = $(this).val();
      $('.delete_id').val(delete_id);
    });
  });

  $(document).on('click', '.modal-btn-edit', function() {
    var edit_id = $(this).val();

    $.ajax({
      type: "GET",
      url: 'inventory.php?inventory_id=' + edit_id,
      success: function(response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 404) {
          alert(res.message);
        } else if (res.status == 200) {

          $('#edit_id').val(res.data.id);
          $('#name_edit').val(res.data.name);
        }
      }
    })
  });
</script>