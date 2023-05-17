<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/saleController.php";
include_once $filepath . "/helpers/pagination.php";
include_once $filepath . "/helpers/format.php";

$saleController = new SaleController();
$pag = new Pagination();
$fm = new Format();

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["sale_id"])) {
  $show_sale = $saleController->get_sale_by_id($_GET["sale_id"]);
  if (mysqli_num_rows($show_sale) == 1) {
    $sale = mysqli_fetch_array($show_sale);

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
  $delete_sale = $saleController->delete_sale($delete_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add-btn"])) {
  $insertSale = $saleController->insert_sale($_POST);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit-btn"])) {
  $edit_id = $_POST["edit_id"];
  $updateSale = $saleController->update_sale($_POST, $edit_id);
}

if (isset($_GET["page"])) {
  $page_id = $_GET["page"];
}
/*
Tính giá trị của phân trang, 10 sale trên 1 trang
*/
$result_pagination = $saleController->show_sale();
if ($result_pagination) {
  $sale_total = mysqli_num_rows($result_pagination);

  // Số sản phẩm trên 1 trang
  $page_total = ceil($sale_total / 10);

  // trang hiện tại
  if (isset($page_id)) {
    $current_page = $page_id;
  }
  // Vị trí hiện tại
  if (isset($current_page)) {
    $current_position = ($current_page - 1) * 10;
  }
  if (isset($current_position)) {
    $result_pagination = $saleController->show_sale_by_pagination(
      $current_position,
      10
    );
  }
}

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_sale_live_search = $saleController->show_sale_live_search($input);
}
?>


<div class="card" id="searchresultsale">
  <div class="bg-modal-box"></div>
  <div class="card-header">
    <h3>Sales List</h3>
    <div class="notification">
      <?php
      if (isset($delete_sale)) {
        echo $delete_sale;
      }
      if (isset($updateSale)) {
        echo $updateSale;
      }
      if (isset($insertSale)) {
        echo $insertSale;
      } ?>
    </div>
    <button type="button" class="modal-btn-add" onclick="AddActive()">
      <p>
        Add sale <span class="las la-plus"></span>
      </p>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive" id="card-sale">
      <table width="100%">
        <thead class="thead">
          <tr>
            <td>ID</td>
            <td>Sale Name</td>
            <td>Create Date</td>
            <td>Start Date</td>
            <td>End Date</td>
            <td>Percent sale</td>
            <td>Status</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($show_sale_live_search)) {
            if ($show_sale_live_search) {
              while ($result = $show_sale_live_search->fetch_array()) {
          ?>
                <tr>
                  <td>
                    <?php echo $result[0]; ?>
                  </td>
                  <td>
                    <?php echo $result[1]; ?>
                  </td>
                  <td>
                    <?php echo $result[2]; ?>
                  </td>
                  <td>
                    <?php echo $result[3]; ?>
                  </td>
                  <td>
                    <?php echo $result[4]; ?>
                  </td>
                  <td>
                    <?php echo $result[5]; ?>
                  </td>
                  <td>
                    <?php if ($result[6] == 1) {
                      echo "<span>Còn áp dụng</span>";
                    } else {
                      echo "<span>Hết áp dụng</span>";
                    } ?>
                  </td>
                  <td>
                    <div class="action-btn-group">
                      <div class="action-btn-edit" id="action-btn-edit-<?php echo $result[0] ?>">
                        <a class="modal-btn-edit" data-id="<?php echo $result[0] ?>" onclick="EditActive(<?php echo $result[0] ?>)">
                          Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i>
                        </a>
                      </div>
                      <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0] ?>">
                        <a class="modal-btn-delete" data-id="<?php echo $result[0] ?>" onclick="DeleteActive(<?php echo $result[0] ?>)">
                          Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
            <?php }
            } else {
              echo "<span class='error'>No Data Found</span>";
            } ?>
        </tbody>
      </table>
    <?php
          } else if ($result_pagination) {
    ?>
      <tbody id="sale-data">
        <?php if ($result_pagination) {
              while ($result = $result_pagination->fetch_array()) { ?>
            <tr>
              <td>
                <?php echo $result[0]; ?>
              </td>
              <td>
                <?php echo $result[1]; ?>
              </td>
              <td>
                <?php echo $result[2]; ?>
              </td>
              <td>
                <?php echo $result[3]; ?>
              </td>
              <td>
                <?php echo $result[4]; ?>
              </td>
              <td>
                <?php echo $result[5]; ?>
              </td>
              <td>
                <?php if ($result[6] == 1) {
                  echo "<span>Còn áp dụng</span>";
                } else {
                  echo "<span>Hết áp dụng</span>";
                } ?>
              </td>
              <td>
                <div class="action-btn-group">
                  <div class="action-btn-edit" id="action-btn-edit-<?php echo $result[0] ?>">
                    <a class="modal-btn-edit" data-id="<?php echo $result[0] ?>" onclick="EditActive(<?php echo $result[0] ?>)">
                      Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i>
                    </a>
                  </div>
                  <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0] ?>">
                    <a class="modal-btn-delete" data-id="<?php echo $result[0] ?>" onclick="DeleteActive(<?php echo $result[0] ?>)">
                      Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                    </a>
                  </div>
                </div>
              </td>
            </tr>
      <?php }
            }
          } ?>
      </tbody>
      </table>
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
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $current_page -
                                                                1; ?>">
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
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $current_page + 1; ?>">
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
        <div id="name_edit_result"></div>
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
        <div id="percent_edit_result"></div>
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

    <input onclick="ClickConfirmModal()" class="modal-edit-btn" id="edit-btn" name="edit-btn" type="submit" value="Save">
  </form>
  <!-- modal edit end -->

  <!-- modal add  -->
  <form class="modal-container-add" id="modal-container-add" method="post" enctype="multipart/form-data">
    <div class="modal-container-add-close" onclick="closeCurdAddModal()"><span><i class="fa-solid fa-circle-xmark"></i></span></div>
    <div class="modal-add-info">
      <div class="modal-add-info-item">
        <label for="name">Name</label>
        <input type="text" id="name_add" name="name_add" required value="">
        <div id="name_add_result"></div>
      </div>

      <div class="modal-add-info-item">
        <label for="start">Start date</label>
        <input type="date" id="start_add" name="start_add" required value="">
      </div>

      <div class="modal-add-info-item">
        <label for="end">End date</label>
        <input type="date" id="end_add" name="end_add" required value="">
      </div>

      <div class="modal-add-info-item">
        <label for="percent">Percent</label>
        <input type="number" id="percent_add" name="percent_add" required value="">
        <div id="percent_add_result"></div>
      </div>

      <div class="modal-add-info-item">
        <label for="status">Status</label>
        <select class="modal-add-input-select" id="status_add" name="status_add" required>
          <option value="">Select status</option>
          <option value="1">Còn áp dụng</option>
          <option value="0">Hết áp dụng</option>
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
      url: 'sale.php?sale_id=' + edit_id,
      success: function(response) {
        var res = jQuery.parseJSON(response);
        console.log(res);
        if (res.status == 404) {
          alert(res.message);
        } else if (res.status == 200) {

          $('#edit_id').val(res.data.id);
          $('#name_edit').val(res.data.name);
          $('#start_edit').val(res.data.start_date);
          $('#end_edit').val(res.data.end_date);
          $('#percent_edit').val(res.data.percent_sale);
          $('#status_edit').val(res.data.status);
        }
      }
    })
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    function loadSale(page) {
      $.ajax({
        url: "sale.php",
        type: "POST",
        data: {
          page_no: page
        },
        success: function(data) {
          $('#sale-data').html(data);
        }
      });
    }

    // Pagination code
    $(document).on("click", "#pagination a", function(e) {
      var page = $(this).attr("id");
      loadSale(page);
    });
  });
</script>

<!-- coding check input value function -->
<script type="text/javascript">
  $(document).ready(function() {
    // add

    $("#name_add, #percent_add").keyup(function() {
      var nameInput = $("#name_add").val();
      var percentInput = $("#percent_add").val();

      var isNameValid = checkProductName(nameInput);
      var isPercentValid = checkSalePercent(percentInput);

      if (!isNameValid || !isPercentValid) {
        if (!isNameValid) {
          $("#add-btn").prop("disabled", true);
          $("#add-btn").css("background-color", "red");
          $("#name_add_result").html("<span class='error'>Sale Name must < 25 characters and don't contain special characters.</span>");
          $("#name_add_result").css("display", "block");
          $("#name_add_result").css("margin-top", "1rem");
        } else {
          $("#name_add_result").css("display", "none");
        }
        if (!isPercentValid) {
          $("#add-btn").prop("disabled", true);
          $("#add-btn").css("background-color", "red");
          $("#percent_add_result").html("<span class='error'>Sale Percent Not Valid</span>");
          $("#percent_add_result").css("display", "block");
          $("#percent_add_result").css("margin-top", "1rem");
        } else {
          $("#percent_add_result").css("display", "none");
        }
      } else {
        $("#add-btn").prop("disabled", false);
        $("#add-btn").css("background-color", "#0be881");
        $("#name_add_result").css("display", "none");
        $("#percent_add_result").css("display", "none");
      }
    });

    // edit
    
    $("#name_edit, #percent_edit").keyup(function() {
      var nameInput = $("#name_edit").val();
      var percentInput = $("#percent_edit").val();

      var isNameValid = checkProductName(nameInput);
      var isPercentValid = checkSalePercent(percentInput);

      if (!isNameValid || !isPercentValid) {
        if (!isNameValid) {
          $("#edit-btn").prop("disabled", true);
          $("#edit-btn").css("background-color", "red");
          $("#name_edit_result").html("<span class='error'>Sale Name must < 25 characters and don't contain special characters.</span>");
          $("#name_edit_result").css("display", "block");
          $("#name_edit_result").css("margin-top", "1rem");
        } else {
          $("#name_edit_result").css("display", "none");
        }
        if (!isPercentValid) {
          $("#edit-btn").prop("disabled", true);
          $("#edit-btn").css("background-color", "red");
          $("#percent_edit_result").html("<span class='error'>Sale Percent Not Valid</span>");
          $("#percent_edit_result").css("display", "block");
          $("#percent_edit_result").css("margin-top", "1rem");
        } else {
          $("#percent_edit_result").css("display", "none");
        }
      } else {
        $("#edit-btn").prop("disabled", false);
        $("#edit-btn").css("background-color", "#ffa800");
        $("#name_edit_result").css("display", "none");
        $("#percent_edit_result").css("display", "none");
      }
    });
  });
</script>