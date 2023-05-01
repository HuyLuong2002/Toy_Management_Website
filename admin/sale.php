<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/saleController.php";
include_once $filepath . "/helpers/pagination.php";

$saleController = new SaleController();
$pag = new Pagination();

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_sale_live_search = $saleController->show_sale_live_search($input);
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["deleteid"])) {
  $delete_id = $_GET["deleteid"];
  $delete_sale = $saleController->delete_sale($delete_id);
}

if (isset($_GET["page"])) {
  $page_id = $_GET["page"];
  $pagination_id = $page_id;
}
/*
Tính giá trị của phân trang, 10 sale trên 1 trang
*/
$result_pagination = $saleController->show_sale();
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
?>


<div class="card" id="searchresultsale">
  <div class="bg-modal-box"></div>
  <div class="card-header">
    <h3>Sales List</h3>
    <div class="notification">
      <?php if (isset($delete_sale)) {
        echo $delete_sale;
      } ?>
    </div>
    <button type="button">
      <a href="sale_add.php">
        Add sale <span class="las la-plus"></span>
      </a>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
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
              while ($result = $show_sale_live_search->fetch_array()) { ?>
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
                    <a href="sale_edit.php?id=<?php echo $result[0]; ?>" class="edit">Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i></a>
                    <a href="?id=<?php echo $id; ?>&page=<?php echo $page_id; ?>&deleteid=<?php echo $result[0]; ?>" class="delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
                  <td>
                </tr>
            <?php }
            } else {
              echo "<span class='error'>No Data Found</span>";
            } ?>
        </tbody>
      </table>
    <?php
          } else {
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
                  <div class="action-btn-edit">
                    <a href="sale_edit.php?id=<?php echo $result[0]; ?>" class="edit">Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i></a>
                  </div>
                  <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0] ?>">
                    <span onclick="DeleteActive(<?php echo $result[0] ?>)">
                      Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                    </span>
                  </div>
                  <!-- Modal delete -->
                  <div class="modal-container-delete" id="modal-container-delete-<?php echo $result[0] ?>">
                    <div class="modal-delete-title">
                      Are you sure want to delete?
                    </div>
                    <div class="modal-delete-btn-group">
                      <a href="?id=<?php echo $id; ?>&page=<?php echo $page_id; ?>&deleteid=<?php echo $result[0]; ?>" class="modal-delete-btn delete-btn">Delete</a>

                      <button class="modal-delete-btn delete-btn-cancel" 
                      id="delete-btn-cancel-<?php echo $result[0] ?>" onclick="DeleteActive(<?php echo $result[0] ?>)">
                        <span>Cancel</span>
                      </button>
                    </div>
                  </div>
                  <!-- modal delete end -->
                </div>
              <td>
            </tr>
      <?php }
            }
          } ?>
      </tbody>
      </table>
      <?php if (empty($_POST["input"])) { ?>
        <div class="bottom-pagination" id="pagination">
          <ul class="pagination">
            <?php if ($pagination_id > 1) { ?>
              <li class="item prev-page">
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $pagination_id -
                                                                1; ?>">
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
            <?php if ($page_total - 1 > $pagination_id + 1) { ?>
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
</div>

<script>
  // const btn_delete = document.getElementById("action-btn-delete");
  // const btn_delete_cancel = document.querySelector(".modal-delete-btn.delete-btn-cancel");
  // const modal_delete = document.querySelector(".modal-container-delete");
  // btn_delete.addEventListener("click", function(){
  //   modal_delete.classList.add("active");
  // });
</script>
<script src="./js/modal.js"></script>

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

<script>
  $(document).ready(function() {

    $("#btnSubmit").click(function() {

      var name = $("#name").val();
      var start = $("#start").val();
      var end = $("#end").val();
      var percent = $("#percent").val();
      var status = $("#status").val();
      var submit = $("#btnSubmit").val();

      if (name == '' || start == '' || end == '' || percent == '' || status == '') {
        alert("Please fill all fields.");
        return false;
      }
      if (start < end) {
        alert("Start date must be greater than end date");
        return false;
      }

      $.ajax({
        type: "POST",
        url: "sale.php",
        data: {
          name: name,
          start: start,
          end: end,
          percent: percent,
          status: status,
          submit: submit
        },
        cache: false,
        success: function(data) {
          alert("Add data successfully");
        },
        error: function(xhr, status, error) {
          console.error(xhr);
        }
      });

    });

  });
</script>