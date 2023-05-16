<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/database/connectDB.php";
include_once $filepath . "/controller/ordersController.php";
include_once $filepath . "/controller/detail_orderController.php";
include_once $filepath . "/helpers/pagination.php";


$orderController = new OrderController();
$detailOrderController = new DetailOrderController();
$pag = new Pagination();

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_orders_live_search = $orderController->show_orders_live_search($input);
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $update_status_order = $orderController->update_status_order($_POST);
  $post = $_POST["submit"];
}


if (isset($_GET["detailid"])) {
  include "orders_detail.php";
}

if (isset($_POST["delete-btn"])) {
  $delete_id = $_POST["delete_id"];
  $delete_order = $orderController->delete_orders($delete_id);
}

if (isset($_GET["page"])) {
  $page_id = $_GET["page"];
}
/*
Tính giá trị của phân trang, 10 sale trên 1 trang
*/
$result_pagination = $orderController->show_orders_user();
if ($result_pagination) {
  $order_total = mysqli_num_rows($result_pagination);

  // Số sản phẩm trên 1 trang
  $page_per = 10;
  $page_total = ceil($order_total / $page_per);

  // trang hiện tại
  if (isset($page_id)) {
    $current_page = $page_id;
  }
  // Vị trí hiện tại
  if (isset($current_page)) {
    $current_position = ($current_page - 1) * $page_per;
  }
  if (isset($current_position)) {
    $result_pagination = $orderController->show_order_by_pagination(
      $current_position,
      $page_per
    );
  }
}

?>

<div class="card" id="searchresultorders">
  <div class="card-header">
    <div class="bg-modal-box"></div>
    <h3>Orders List</h3>
    <button id="loc">Lọc</button>
    <div class="notification-order">
      <?php
      if (isset($delete_order)) {
        echo $delete_order;
      }
      ?>
    </div>
  </div>

  <div class="card-body">
    <div class="table-responsive" id="card-order">
      <table width="100%">
        <thead>
          <tr>
            <td>ID</td>
            <td>User ID</td>
            <td>User Name</td>
            <td>Quantity</td>
            <td>Date</td>
            <td>Phone</td>
            <td>Email</td>
            <td>Country</td>
            <td>Total price</td>
            <td>Status</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody id="">
          <?php if (isset($show_orders_live_search)) {
            if ($show_orders_live_search) { ?>
              <?php while (
                $result = $show_orders_live_search->fetch_array()
              ) { ?>
                <tr>
                  <td>
                    <?php echo $result[0]; ?>
                  </td>
                  <td>
                    <?php echo $result[1]; ?>
                  </td>
                  <td>
                    <?php echo $result[15]; ?>
                  </td>
                  <td>
                    <?php echo $result[2]; ?>
                  </td>
                  <td>
                    <?php echo $result[3]; ?>
                  </td>
                  <td>
                    <?php echo $result[5]; ?>
                  </td>
                  <td>
                    <?php echo $result[6]; ?>
                  </td>
                  <td>
                    <?php echo $result[10]; ?>
                  </td>
                  <td>
                    <?php echo $result[11]; ?>
                  </td>
                  <td>
                    <?php if ($result[12] == "0")
                      echo "Đang giao hàng";
                    else if ($result[12] == "1")
                      echo "Đã giao";
                    else if ($result[12] == "2")
                      echo "Chờ xử lý";
                    ?>
                  </td>
                  <td>
                    <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0] ?>">
                      <a class="modal-btn-delete" data-id="<?php echo $result[0] ?>"
                        onclick="DeleteActive(<?php echo $result[0] ?>)">
                        Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                      </a>
                    </div>
                    <a href="?id=3&page=<?php echo $page_id ?>&detailid=<?php echo $result[0]; ?>" class="Detail">Details <i
                        class="fa-solid fa-circle-info" style="color: #03a945;"></i></a>
                    <a class="edit" href="export_pdf_order.php?id=<?php echo $result[0]; ?>">Export PDF <i
                        class="fa-solid fa-file-export"></i></a>
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
          <tbody id="orders-data">
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
                  <?php echo $result[15]; ?>
                  </td>
                  <td>
                  <?php echo $result[2]; ?>
                  </td>
                  <td>
                  <?php echo $result[3]; ?>
                  </td>
                  <td>
                  <?php echo $result[5]; ?>
                  </td>
                  <td>
                  <?php echo $result[6]; ?>
                  </td>
                  <td>
                  <?php echo $result[10]; ?>
                  </td>
                  <td>
                  <?php echo $result[11]; ?>
                  </td>
                  <td>
                    <form method="post" enctype="multipart/form-data" class="status-order">
                      <input type="hidden" value="<?php echo $result[0] ?>" name="id_order">

                      <select id="status_order" value="2" name="status" class="status_order">
                        <option value="0" <?php if ($result[12] == "0")
                          echo "selected"; ?>>Đã giao</option>
                        <option value="1" <?php if ($result[12] == "1")
                          echo "selected"; ?>>Đang giao hàng</option>
                        <option value="2" <?php if ($result[12] == "2")
                          echo "selected"; ?>>Đang chờ duyệt</option>
                      </select>
                      <?php
                      if ($result[12] != "0") {
                        ?>
                        <input type="submit" value="Change" name="submit" />

                      <?php
                      }
                      ?>
                    </form>
                  </td>
                  <td>
                    <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0] ?>">
                      <a class="modal-btn-delete" data-id="<?php echo $result[0] ?>"
                        onclick="DeleteActive(<?php echo $result[0] ?>)">
                        Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                      </a>
                    </div>
                    <a href="?id=3&page=<?php echo $page_id ?>&detailid=<?php echo $result[0]; ?>" class="Detail">Details <i
                        class="fa-solid fa-circle-info" style="color: #03a945;"></i></a>
                    <a class="edit" href="export_pdf_order.php?id=<?php echo $result[0]; ?>">Export PDF <i
                        class="fa-solid fa-file-export"></i></a>
                  </td>
                </tr>
            <?php }
            }
          } ?>
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
  <div class="wrap-date-choose">
    <div class="data-choose hide" id="data-choose">
      <h4>Tìm khoảng thời gian</h4>
      <form>
        <div class="wrap-date">
          <div class="start-date">
            <label for="start_date">Ngày bắt đầu:</label>
            <input type="date" id="start_date" name="start_date" required dateFormat="yyyy-mm-dd">
          </div>

          <div class="end-date">
            <label for="end_date">Ngày kết thúc:</label>
            <input type="date" id="end_date" name="end_date" required dateFormat="yyyy-mm-dd">
          </div>
        </div>

        <button id="search-btn" class="btn-form" type="submit" onclick="validateDateInputs(event)">Tìm</button>
      </form>

      <div id="close-icon">
        X
      </div>
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
      <button type="button" class="modal-delete-btn delete-btn-cancel" id="delete-btn-cancel"
        onclick="cancelDeleteModal()">
        <span>Cancel</span>
      </button>
    </div>
  </form>
  <!-- modal delete end -->
</div>

<script>
</script>

<script>
  $(document).ready(function () {
    $('.modal-btn-delete').click(function (e) {
      e.preventDefault();
      var delete_id = $(this).data('id');
      console.log(delete_id);
      $('.delete_id').val(delete_id);
    });
  });
</script>

<script src="./js/modal_product_order.js"></script>

<script>
  var bg_modal_detail_box = document.querySelector(".orders-details");
  var modal_detail = document.querySelector(".orders-info");
  bg_modal_detail_box.addEventListener("click", function (event) {
    // Kiểm tra xem sự kiện click có xảy ra bên ngoài cửa sổ popup hay không
    if (event.target === bg_modal_detail_box) {
      // Nếu có, đóng cửa sổ popup
      modal_detail.classList.add('hidden');
      bg_modal_detail_box.classList.add('hidden');
    }
  });
</script>

<script>
  var loc = document.querySelector("#loc");
  var khung = document.querySelector("#data-choose");
  loc.addEventListener("click", function (event) {
    if (event.target === loc) {
      khung.classList.remove('hide');
      loc.classList.add('hide');
    }
  });
  // Closekhung
  var close = document.querySelector('#close-icon');
  close.addEventListener("click", function (event) {
    if (event.target === close) {
      loc.classList.remove('hide');
      khung.classList.add('hide');
    }
  });
</script>

<!-- <script>
  // ShowOrderDetail
  const handleShowCart = () => {
    const layout = document.getElementById("orders-details");
    layout.style.display = "flex";

    // Handle Out Of Area Click
    const screen = document.getElementById("orders-details");
    screen.addEventListener('click', (event) => {
      const box = document.getElementsByClassName('modal-container')[0];
      if (!box.contains(event.target)) {
        handleClose();
      }
    });
  }

  // CloseOrderDetail
  const handleClose = () => {
    const layout = document.getElementById("orders-details")
    layout.style.display = "none";
  }
</script> -->