<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/providersController.php";
include_once $filepath . "/helpers/pagination.php";

$providerController = new ProviderController();
$pag = new Pagination();

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_provider_live_search = $providerController->show_provider_live_search($input);
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["provider_id"])) {
  $show_provider = $providerController->get_provider_by_id($_GET["provider_id"]);
  if (mysqli_num_rows($show_provider) == 1) {
    $sale = mysqli_fetch_array($show_provider);

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

if (isset($_GET["page"])) {
  $page_id = $_GET["page"];
  $pagination_id = $page_id;
}

if (isset($_POST["delete-btn"])) {
  $delete_id = $_POST["delete_id"];
  $delete_provider = $providerController->delete_provider($delete_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add-btn"])) {
  $insertProvider = $providerController->insert_provider($_POST);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit-btn"])) {
  $edit_id = $_POST["edit_id"];
  $updateProvider = $providerController->update_provider($_POST, $edit_id);
}

if (isset($_GET["detailid"])) {
  include "orders_detail.php";
}

/*
Tính giá trị của phân trang
10 sản phẩm trên 1 trang
*/
$result_pagination = $providerController->show_provider_for_pagination();

/*
Tính giá trị của phân trang
10 sản phẩm trên 1 trang
*/
// Tổng số sản phẩm
if ($result_pagination) {
  $provider_total = mysqli_num_rows($result_pagination);
  //số sản phẩm trên 1 trang
  $num_product_on_page = 10;
  $page_total = ceil($provider_total / $num_product_on_page);
  //Trang hiện tại
  if (isset($page_id))
    $current_page = $page_id;
  // vị trí hiện tại
  if (isset($current_page))
    $current_position = ($current_page - 1) * $num_product_on_page;
  if (isset($current_position))
    $result_pagination = $providerController->show_provider_by_panigation_admin($current_position, $num_product_on_page);
}

?>


<div class="card" id="searchresultprovider">
  <div class="bg-modal-box"></div>
  <div class="card-header">
    <h3>Providers List</h3>

    <div class="notification">
      <?php

      if (isset($delete_provider)) {
        echo $delete_provider;
      }
      if (isset($insertProvider)) {
        echo $insertProvider;
      }
      if (isset($updateProvider)) {
        echo $updateProvider;
      }
      ?>
    </div>
    <button type="button" class="modal-btn-add" onclick="AddActive()">
      <p>
        Add Provider <span class="las la-plus"></span>
      </p>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive" id="card-provider">
      <table width="100%">
        <thead>
          <tr>
            <td>ID</td>
            <td>Provider Name</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($show_provider_live_search)) {
            if ($show_provider_live_search) { ?>
              <?php while (
                $result = $show_provider_live_search->fetch_array()
              ) { ?>
                <tr>
                  <td>
                    <?php echo $result[0]; ?>
                  </td>
                  <td>
                    <?php echo $result[1]; ?>
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
      <tbody id="provider-data">
        <?php
            if ($result_pagination) {
              while ($result = $result_pagination->fetch_array()) { ?>
            <tr>
              <td>
                <?php echo $result[0]; ?>
              </td>
              <td>
                <?php echo $result[1]; ?>
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
      <?php
      if (empty($_POST["input"]) && isset($page_total) && $page_total > 1) {
      ?>
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
    </div>

    <input class="modal-edit-btn" id="edit-btn" name="edit-btn" type="submit" value="Save">
  </form>
  <!-- modal edit end -->

  <!-- modal add -->
  <form class="modal-container-add" id="modal-container-add" method="post" enctype="multipart/form-data">
    <div class="modal-container-add-close" onclick="closeCurdAddModal()"><span><i class="fa-solid fa-circle-xmark"></i></span></div>
    <div class="modal-add-info">
      <div class="modal-add-info-item">
        <label for="name">Name</label>
        <input type="text" id="name_add" name="name_add" required value="">
        <div id="name_add_result"></div>
      </div>
    </div>

    <input onclick="" class="modal-add-btn" id="add-btn" name="add-btn" type="submit" value="Save">
  </form>
  <!-- modal add end -->
</div>

<script src="./js/modal.js"></script>

<!-- ajax to pagination for provider -->
<script type="text/javascript">
  $(document).ready(function() {
    function loadProduct(page) {
      $.ajax({
        url: "providers.php",
        type: "POST",
        data: {
          page_no: page
        },
        success: function(data) {
          $('#provider-data').html(data);
        }

      });
    }

    // Pagination code
    $(document).on("click", "#pagination a", function(e) {

      var page = $(this).attr("id");
      loadProduct(page);
    });

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
      url: 'providers.php?provider_id=' + edit_id,
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


<script src="./js/validate_input.js"></script>

<!-- coding check input value function -->
<script type="text/javascript">
  $(document).ready(function() {
    $("#name_add").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEditProvider(input) == false) {
        $("#name_add_result").html("<span class='error'>Provider Name Not Valid</span>");
        $("#add-btn").prop("disabled", true);
        $("#add-btn").css("background-color", "red");
        $("#name_add_result").css("display", "block");
        $("#name_add_result").css("margin-top", "1rem");
      } else {
        $("#name_add_result").css("display", "none");
        $("#add-btn").prop("disabled", false);
        $("#add-btn").css("background-color", "#0be881");
      }
    });

    $("#name_edit").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEditProvider(input) == false) {
        $("#name_edit_result").html("<span class='error'>Provider Name Not Valid</span>");
        $("#edit-btn").prop("disabled", true);
        $("#edit-btn").css("background-color", "red");
        $("#name_edit_result").css("display", "block");
        $("#name_edit_result").css("margin-top", "1rem");
      } else {
        $("#name_edit_result").css("display", "none");
        $("#edit-btn").prop("disabled", false);
        $("#edit-btn").css("background-color", "#ffa800");
      }
    });
  });
</script>