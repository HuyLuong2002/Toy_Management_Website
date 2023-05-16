<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\controller\inventory_detailController.php";
include_once $filepath . "/controller/productsController.php";
include_once $filepath . "/controller/inventoryController.php";
include_once $filepath . "/helpers/pagination.php";

$inventory_detailController = new InventoryDetailController();
$pag = new Pagination();

if (isset($_GET["enter_id"])) {
  $enter_id = $_GET["enter_id"];
  settype($enter_id, "int");
}

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_inventory_detail_live_search = $inventory_detailController->show_inventory_detail_live_search($input);
}

if (isset($_GET["inventory_detail_id"])) {
  $show_inventory_detail = $inventory_detailController->get_detail_enter_by_id($_GET["inventory_detail_id"]);
  if (mysqli_num_rows($show_inventory_detail) == 1) {
    $sale = mysqli_fetch_array($show_inventory_detail);

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
  $deleteInventoryDetail = $inventory_detailController->delete_inventory_detail($delete_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add-btn"])) {
  $insertInventoryDetail = $inventory_detailController->insert_inventory_detail($_POST);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit-btn"])) {
  $edit_id = $_POST["edit_id"];
  $updateInventoryDetail = $inventory_detailController->update_inventory_detail($_POST, $edit_id);
}

if (isset($_GET["page_detail"])) {
  $page_id = $_GET["page_detail"];
  settype($page_id, "int");
}

/*
Tính giá trị của phân trang, 10 sale trên 1 trang
*/
if (isset($enter_id)) {
  $result_pagination = $inventory_detailController->show_inventory_detail($enter_id);
  if ($result_pagination) {
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
  }
}


?>

<div class="card" id="searchresultinventorydetail">
  <div class="card-header">
    <div class="bg-modal-box"></div>
    <button>
      <a class="back-btn" href="index.php?id=4&page=1">
        <i class="fa-solid fa-arrow-left"></i> Receipt List
      </a>
    </button>
    <div class="notification">
      <?php
      if (isset($deleteInventoryDetail)) {
        echo $deleteInventoryDetail;
      }
      if (isset($insertInventoryDetail)) {
        echo $insertInventoryDetail;
      }
      if (isset($updateInventoryDetail)) {
        echo $updateInventoryDetail;
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
    <div class="table-responsive" id="card-inventory-detail">
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
          <?php if (isset($show_inventory_detail_live_search)) {
            if ($show_inventory_detail_live_search) {
              while ($result = $show_inventory_detail_live_search->fetch_array()) {
          ?>
                <tr>
                  <td><?php echo $result[0]; ?></td>
                  <td><?php echo $result[1]; ?></td>
                  <td><?php echo $result[2]; ?></td>
                  <td><?php echo $result[5]; ?></td>
                  <td><?php echo number_format($result[3], 0, '.', ',') ?></td>
                  <td><?php echo number_format($result[4], 0, '.', ',') ?></td>
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
      <tbody>
        <?php
            if (isset($result_pagination)) {
              while ($result = $result_pagination->fetch_array()) {
        ?>
            <tr>
              <td><?php echo $result[0]; ?></td>
              <td><?php echo $result[1]; ?></td>
              <td><?php echo $result[2]; ?></td>
              <td><?php echo $result[5]; ?></td>
              <td><?php echo number_format($result[3], 0, '.', ',') ?></td>
              <td><?php echo number_format($result[4], 0, '.', ',') ?></td>
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
              <a href="index.php?id=<?php echo $id; ?>&page_detail=<?php echo $first_page ?>&enter_id=<?php echo $enter_id ?>">
                First
              </a>
            </li>
          <?php } ?>

          <?php if ($current_page > 3) { ?>
            <li class="item prev-page">
              <a href="index.php?id=<?php echo (string) $id; ?>&page_detail=<?php echo $current_page - 1; ?>&enter_id=<?php echo $enter_id ?>">
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
                  <a href="index.php?id=<?php echo $id; ?>&page_detail=<?php echo $num ?>&enter_id=<?php echo $enter_id ?>">
                    <?php echo $num; ?>
                  </a>
                </li>
              <?php
              }
            } else {
              ?>
              <li class="item <?php echo "current" ?>" id="<?php echo $num; ?>">
                <a href="index.php?id=<?php echo $id; ?>&page_detail=<?php echo $num; ?>&enter_id=<?php echo $enter_id ?>">
                  <?php echo $num; ?>
                </a>
              </li>
          <?php
            }
          }
          ?>

          <?php if ($current_page <= $page_total - 3) { ?>
            <li class="item next-page">
              <a href="index.php?id=<?php echo (string) $id; ?>&page_detail=<?php echo $current_page + 1; ?>&enter_id=<?php echo $enter_id ?>">
                <i class="fa-solid fa-chevron-right"></i>
              </a>
            </li>
          <?php } ?>

          <?php if ($current_page <= $page_total - 3) {
            $lastpage = $page_total;
          ?>
            <li class="item last-page">
              <a href="index.php?id=<?php echo $id; ?>&page_detail=<?php echo $lastpage ?>&enter_id=<?php echo $enter_id ?>">
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
        <label for="enter-id">Enter ID</label>
        <select class="modal-edit-input-select" id="enter-id_edit" name="enter-id_edit" required>
          <option value="">Select enter</option>
          <?php
          $inventoryController = new InventoryController();
          $show_inventory = $inventoryController->show_inventory();
          if ($show_inventory) {
            $i = 0;
            while ($result = $show_inventory->fetch_assoc()) {
              $i++; ?>
              <option value="<?php echo $result["id"]; ?>"><?php echo $result["id"]; ?></option>
          <?php
            }
          }
          ?>
        </select>
      </div>

      <div class="modal-edit-info-item">
        <label for="enter-id">Product</label>
        <select class="modal-edit-input-select" id="product_edit" name="product_edit" required>
          <option value="">Select product</option>
          <?php
          $productsController = new ProductsController();
          $show_product = $productsController->show_product_receipt();
          if ($show_product) {
            $i = 0;
            while ($result = $show_product->fetch_assoc()) {
              $i++; ?>
              <option value="<?php echo $result["id"]; ?>"><?php echo $result["name"]; ?></option>
          <?php
            }
          }
          ?>
        </select>
      </div>

      <div class="modal-edit-info-item">
        <label for="quantity">Quantity</label>
        <input type="text" id="quantity_edit" name="quantity_edit" required>
        <div id="quantity_edit_result"></div>
      </div>

      <div class="modal-edit-info-item">
        <label for="price">Price</label>
        <input type="text" id="price_edit" name="price_edit" required>
        <div id="price_edit_result"></div>
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
        <label for="enter-id">Enter ID</label>
        <select class="modal-add-input-select" id="enter-id_add" name="enter-id_add" required>
          <option value="">Select enter</option>
          <?php
          $inventoryController = new InventoryController();
          $show_inventory = $inventoryController->show_inventory();
          if ($show_inventory) {
            $i = 0;
            while ($result = $show_inventory->fetch_assoc()) {
              $i++; ?>
              <option value="<?php echo $result["id"]; ?>"><?php echo $result["id"]; ?></option>
          <?php
            }
          }
          ?>
        </select>
      </div>

      <div class="modal-add-info-item">
        <label for="enter-id">Product</label>
        <select class="modal-add-input-select" id="product_add" name="product_add" required>
          <option value="">Select product</option>
          <?php
          $productsController = new ProductsController();
          $show_product = $productsController->show_product_receipt();
          if ($show_product) {
            $i = 0;
            while ($result = $show_product->fetch_assoc()) {
              $i++; ?>
              <option value="<?php echo $result["id"]; ?>"><?php echo $result["name"]; ?></option>
          <?php
            }
          }
          ?>
        </select>
      </div>

      <div class="modal-add-info-item">
        <label for="quantity">Quantity</label>
        <input type="number" id="quantity_add" name="quantity_add" required>
        <div id="quantity_add_result"></div>
      </div>

      <div class="modal-add-info-item">
        <label for="price">Price</label>
        <input type="number" id="price_add" name="price_add" required>
        <div id="price_add_result"></div>
      </div>

    </div>

    <input onclick="" class="modal-add-btn" id="add-btn" name="add-btn" type="submit" value="Save">
  </form>
  <!-- modal add end -->
</div>

<script src="./js/modal.js"></script>

<script src="./js/validate_input.js"></script>

<!-- coding check input value function -->
<script type="text/javascript">
  $(document).ready(function() {

    $("#quantity_add").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEditQuantity(input) == false) {
        $("#quantity_add_result").html("<span class='error'>Quantity Not Valid</span>");
        $("#add-btn").prop("disabled", true);
        $("#add-btn").css("background-color", "red");
        $("#quantity_add_result").css("display", "block");
        $("#quantity_add_result").css("margin-top", "1rem");
      } else {
        $("#quantity_add_result").css("display", "none");
        $("#add-btn").prop("disabled", false);
        $("#add-btn").css("background-color", "#0be881");
      }
    });

    $("#price_add").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEditQuantity(input) == false) {
        $("#price_add_result").html("<span class='error'>Price Not Valid</span>");
        $("#add-btn").prop("disabled", true);
        $("#add-btn").css("background-color", "red");
        $("#price_add_result").css("display", "block");
        $("#price_add_result").css("margin-top", "1rem");
      } else {
        $("#price_add_result").css("display", "none");
        $("#add-btn").prop("disabled", false);
        $("#add-btn").css("background-color", "#0be881");
      }
    });



    //edit
    $("#quantity_edit").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEditQuantity(input) == false) {
        $("#total-quantity_edit_result").html("<span class='error'>Price Not Valid</span>");
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

    $("#price_edit").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEditQuantity(input) == false) {
        $("#quantity_edit_result").html("<span class='error'>Price Not Valid</span>");
        $("#edit-btn").prop("disabled", true);
        $("#edit-btn").css("background-color", "red");
        $("#quantity_edit_result").css("display", "block");
        $("#quantity_edit_result").css("margin-top", "1rem");
      } else {
        $("#price_edit_result").css("display", "none");
        $("#edit-btn").prop("disabled", false);
        $("#edit-btn").css("background-color", "#ffa800");
      }
    });
  });
</script>

<script>
  $(document).on('click', '#search', function() {
    var detail_search = $('.inventory_detail').val();

    $('#inventory_detail2').val(detail_search);
  });

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
      url: 'inventory_detail.php?inventory_detail_id=' + edit_id,
      success: function(response) {
        var res = jQuery.parseJSON(response);
        console.log(res);
        if (res.status == 404) {
          alert(res.message);
        } else if (res.status == 200) {

          $('#edit_id').val(res.data.id);
          $('#enter-id_edit').val(res.data.enter_id);
          $('#quantity_edit').val(res.data.quantity);
          $('#price_edit').val(res.data.price);
          $('#product_edit').val(res.data.product_id);
        }
      }
    })
  });
</script>