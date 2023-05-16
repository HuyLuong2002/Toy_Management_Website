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

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_inventory_live_search = $inventoryController->show_inventory_live_search($input);
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
}

/*
Tính giá trị của phân trang, 10 sale trên 1 trang
*/
$result_pagination =  $inventoryController->show_inventory();
if ($result_pagination) {
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
}

?>

<div class="card" id="searchresultinventory">
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
        Add inventory <span class="las la-plus"></span>
      </p>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive" id="card-inventory">
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
          <?php if (isset($show_inventory_live_search)) {
            if ($show_inventory_live_search) {
              while ($result = $show_inventory_live_search->fetch_array()) {
          ?>
                <tr>
                  <td><?php echo $result[0]; ?></td>
                  <td><?php echo $result[1]; ?></td>
                  <td><?php echo number_format($result[2], 0, '.', ',') ?></td>
                  <td><?php echo number_format($result[3], 0, '.', ',')?></td>
                  <td><?php echo $result[9]; ?></td>
                  <td><?php echo $result[10] . " " . $result[11]; ?></td>
                  <td><?php echo $result[6] == 1 ?  "Đã giao" : "Đang giao hàng"; ?></td>
                  <td><?php echo $result[7]; ?></td>
                  <td>
                    <div class="action-btn-group">
                      <div class="action-btn-edit" id="action-btn-edit-<?php echo $result[0] ?>">
                        <a class="modal-btn-edit" data-id="<?php echo $result[0] ?>" onclick="EditActive(<?php echo $result[0] ?>)">
                          Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i>
                        </a>
                      </div>
                      <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0] ?>">
                        <a class="modal-btn-delete" data-id="<?php echo $result[0] ?>" onclick="DeleteActive(<?php echo $result[0] ?>)">
                          Delete<i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                        </a>
                      </div>
                      <?php
                      ?>
                      <a href="?id=11&page_detail=<?php echo $page_id ?>&enter_id=<?php echo $result[0]; ?>" class="Detail">Details <i class="fa-solid fa-circle-info" style="color: #03a945;"></i></a>
                    </div>
                  </td>
                </tr>
            <?php
              }
            } else {
              echo "<span class='error'>No Data Found</span>";
            }
            ?>
        </tbody>
      </table>
    <?php } else if ($result_pagination) { ?>
      <tbody id="inventory-data">
        <?php
            if (isset($result_pagination)) {
              while ($result = $result_pagination->fetch_array()) {
        ?>
            <tr>
              <td><?php echo $result[0]; ?></td>
              <td><?php echo $result[1]; ?></td>
              <td><?php echo number_format($result[2], 0, '.', ',') ?></td>
              <td><?php echo number_format($result[3], 0, '.', ',') ?></td>
              <td><?php echo $result[9]; ?></td>
              <td><?php echo $result[10] . " " . $result[11]; ?></td>
              <td><?php echo $result[6] == 1 ?  "Đã giao" : "Đang giao hàng"; ?></td>
              <td><?php echo $result[7]; ?></td>
              <td>
                <div class="action-btn-group">
                  <div class="action-btn-edit" id="action-btn-edit-<?php echo $result[0] ?>">
                    <a class="modal-btn-edit" data-id="<?php echo $result[0] ?>" onclick="EditActive(<?php echo $result[0] ?>)">
                      Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i>
                    </a>
                  </div>
                  <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0] ?>">
                    <a class="modal-btn-delete" data-id="<?php echo $result[0] ?>" onclick="DeleteActive(<?php echo $result[0] ?>)">
                      Delete<i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                    </a>
                  </div>
                  <?php
                  ?>
                  <a href="?id=11&page_detail=<?php echo $page_id ?>&enter_id=<?php echo $result[0]; ?>" class="Detail">Details <i class="fa-solid fa-circle-info" style="color: #03a945;"></i></a>
                </div>
              </td>
            </tr>
      <?php
              }
            }
          }
      ?>
      </tbody>
      </table>
    </div>

    <?php if (empty($_POST["input"]) && isset($page_total) && $page_total > 1) { ?>
      <div class="bottom-pagination" id="pagination">
        <ul class="pagination">
          <?php if ($current_page > 3) {
            $first_page = 1;
          ?>
            <li class="item first-page">
              <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $first_page ?>">
                First
              </a>
            </li>
          <?php } ?>

          <?php if ($current_page > 3) { ?>
            <li class="item prev-page">
              <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $current_page - 1; ?>">
                <i class="fa-solid fa-chevron-left"></i>
              </a>
            </li>
          <?php } ?>

          <?php
          for ($num = 1; $num <= $page_total; $num++) {
            if ($num != $current_page) {
              if ($num > $current_page - 3 && $num < $current_page + 3) {
          ?>
                <li class="item" id="<?php echo $num; ?>">
                  <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $num ?>">
                    <?php echo $num; ?>
                  </a>
                </li>
              <?php
              }
            } else {
              ?>
              <li class="item <?php echo "current" ?>" id="<?php echo $num; ?>">
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $num; ?>">
                  <?php echo $num; ?>
                </a>
              </li>
          <?php
            }
          }
          ?>

          <?php if ($current_page <= $page_total - 3) { ?>
            <li class="item next-page">
              <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $current_page +
                                                              1; ?>">
                <i class="fa-solid fa-chevron-right"></i>
              </a>
            </li>
          <?php } ?>

          <?php if ($current_page <= $page_total - 3) {
            $lastpage = $page_total;
          ?>
            <li class="item last-page">
              <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $lastpage ?>">
                Last
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
        <label for="enter-date_edit">Enter Date</label>
        <input type="date" id="enter-date_edit" name="enter-date_edit" required>
      </div>

      <div class="modal-edit-info-item">
        <label for="total-quantity_edit">Total Quantity</label>
        <input type="text" id="total-quantity_edit" name="total-quantity_edit" required>
        <div id="total-quantity_edit_result"></div>
      </div>

      <div class="modal-edit-info-item">
        <label for="total-price_edit">Total Price</label>
        <input type="text" id="total-price_edit" name="total-price_edit" required>
        <div id="total-price_edit_result"></div>
      </div>

      <div class="modal-edit-info-item">
        <label for="provider">Provider</label>
        <select class="modal-edit-input-select" id="provider_edit" name="provider_edit" required>
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

      <div class="modal-edit-info-item">
        <label for="provider">Status</label>
        <select class="modal-edit-input-select" id="status_edit" name="status_edit" required>
          <option value="">Select status</option>
          <option value="1">Đã giao</option>
          <option value="0">Đang giao hàng</option>
        </select>
      </div>
    </div>

    <input class="modal-edit-btn" id="edit-btn" name="edit-btn" type="submit" value="Save">
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
        <input type="number" id="total-quantity_add" name="total-quantity_add" required>
        <div id="total-quantity_add_result"></div>
      </div>

      <div class="modal-add-info-item">
        <label for="total-price_add">Total Price</label>
        <input type="number" id="total-price_add" name="total-price_add" required>
        <div id="total-price_add_result"></div>
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
        <label for="provider">Status</label>
        <select class="modal-add-input-select" id="status_add" name="status_add" required>
          <option value="">Select status</option>
          <option value="1">Đã giao</option>
          <option value="0">Đang giao hàng</option>
        </select>
      </div>
    </div>

    <input onclick="" class="modal-add-btn" id="add-btn" name="add-btn" type="submit" value="Save">
  </form>
  <!-- modal add end -->
</div>

<script src="./js/modal.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.modal-btn-delete').click(function(e) {
      e.preventDefault();
      var delete_id = $(this).data('id');
      $('.delete_id').val(delete_id);
    });
  });

  $(document).on('click', '.modal-btn-edit', function() {
    var edit_id = $(this).data('id');

    $.ajax({
      type: "GET",
      url: 'inventory.php?inventory_id=' + edit_id,
      success: function(response) {
        var res = jQuery.parseJSON(response);
        console.log(res);
        if (res.status == 404) {
          alert(res.message);
        } else if (res.status == 200) {

          $('#edit_id').val(res.data.id);
          $('#enter-date_edit').val(res.data.enter_date);
          $('#total-quantity_edit').val(res.data.total_quantity);
          $('#total-price_edit').val(res.data.total_price);
          $('#provider_edit').val(res.data.provider_id);
          $('#status_edit').val(res.data.status);
        }
      }
    })
  });
</script>

<script src="./js/validate_input.js"></script>

<!-- coding check input value function -->
<script type="text/javascript">
  $(document).ready(function() {
    $("#total-quantity_add").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEditQuantity(input) == false) {
        $("#total-quantity_add_result").html("<span class='error'>Total Quantity Not Valid</span>");
        $("#add-btn").prop("disabled", true);
        $("#add-btn").css("background-color", "red");
        $("#total-quantity_add_result").css("display", "block");
        $("#total-quantity_add_result").css("margin-top", "1rem");
      } else {
        $("#total-quantity_add_result").css("display", "none");
        $("#add-btn").prop("disabled", false);
        $("#add-btn").css("background-color", "#0be881");
      }
    });

    $("#total-price_add").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEditQuantity(input) == false) {
        $("#total-price_add_result").html("<span class='error'>Total Price Not Valid</span>");
        $("#add-btn").prop("disabled", true);
        $("#add-btn").css("background-color", "red");
        $("#total-price_add_result").css("display", "block");
        $("#total-price_add_result").css("margin-top", "1rem");
      } else {
        $("#total-price_add_result").css("display", "none");
        $("#add-btn").prop("disabled", false);
        $("#add-btn").css("background-color", "#0be881");
      }
    });

    //edit
    $("#total-quantity_edit").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEditQuantity(input) == false) {
        $("#total-quantity_edit_result").html("<span class='error'>Total Price Not Valid</span>");
        $("#edit-btn").prop("disabled", true);
        $("#edit-btn").css("background-color", "red");
        $("#total-quantity_edit_result").css("display", "block");
        $("#total-quantity_edit_result").css("margin-top", "1rem");
      } else {
        $("#total-quantity_edit_result").css("display", "none");
        $("#edit-btn").prop("disabled", false);
        $("#edit-btn").css("background-color", "#ffa800");
      }
    });

    $("#total-price_edit").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEditQuantity(input) == false) {
        $("#total-price_edit_result").html("<span class='error'>Total Price Not Valid</span>");
        $("#edit-btn").prop("disabled", true);
        $("#edit-btn").css("background-color", "red");
        $("#total-price_edit_result").css("display", "block");
        $("#total-price_edit_result").css("margin-top", "1rem");
      } else {
        $("#total-price_edit_result").css("display", "none");
        $("#edit-btn").prop("disabled", false);
        $("#edit-btn").css("background-color", "#ffa800");
      }
    });
  });
</script>