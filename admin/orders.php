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

if (isset($_GET["detailid"])) {
  include "orders_detail.php";
}

if (isset($_POST["delete-btn"])) {
  $delete_id = $_POST["delete_id"];
  $delete_order = $orderController->delete_orders($delete_id);
}

if (isset($_GET["page"])) {
  $page_id = $_GET["page"];
  $pagination_id = $page_id;
}
/*
Tính giá trị của phân trang, 10 sale trên 1 trang
*/
$result_pagination = $orderController->show_orders_user();
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
?>

<div class="card" id="searchresultorders">
  <div class="card-header">
    <div class="bg-modal-box order" onclick="closeCurdDeleteModal"></div>
    <h3>Orders List</h3>
    <div class="notification">
      <?php
      if (isset($delete_order)) {
        echo $delete_order;
      }
      ?>
    </div>
    <button>
      <a href="orders_add.php">
        Add orders <span class="las la-plus"></span>
      </a>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table width="100%">
        <thead>
          <tr>
            <td>ID</td>
            <td>User ID</td>
            <td>Quantity</td>
            <td>Date</td>
            <td>Address</td>
            <td>Phone</td>
            <td>Email</td>
            <td>Country</td>
            <td>Total price</td>
            <td>Payment method</td>
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
                    <?php echo $result[6]; ?>
                  </td>
                  <td>
                    <?php echo $result[7]; ?>
                  </td>
                  <td>
                    <?php echo $result[8]; ?>
                  </td>
                  <td>
                    <?php echo $result[9]; ?>
                  </td>
                  <td>
                    <?php if ($result[10] == "0") echo "Đang giao hàng";
                    else if ($result[10] == "1") echo "Đã giao";
                    else if ($result[10] == "2") echo "Chờ xử lý";
                    ?>
                  </td>
                  <td>
                    <a href="?id=3&deleteid=<?php echo $result[0]; ?>" class="Delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
                    <a href="orders_detail.php?id=<?php echo $result[0]; ?>" class="Detail">Details <i class="fa-solid fa-circle-info" style="color: #03a945;"></i></a>
                    <a href="export_pdf_order.php?id=<?php echo $result[0]; ?>">Export PDF</a>
                  </td>
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
                <?php echo $result[6]; ?>
              </td>
              <td>
                <?php echo $result[7]; ?>
              </td>
              <td>
                <?php echo $result[8]; ?>
              </td>
              <td>
                <?php echo $result[9]; ?>
              </td>
              <td>
                <?php if ($result[10] == "0") echo "Đang giao hàng";
                else if ($result[10] == "1") echo "Đã giao";
                else if ($result[10] == "2") echo "Chờ xử lý";
                ?>
              </td>
              <td>
                <!-- <a href="?id=3&page=<?php echo $page_id ?>&deleteid=<?php echo $result[0]; ?>" class="Delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a> -->
                <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0] ?>">
                  <button class="modal-btn-delete" type="button" value="<?php echo $result[0] ?>" onclick="DeleteActive(<?php echo $result[0] ?>)">
                    Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                  </button>
                </div>
                <a href="?id=3&page=<?php echo $page_id ?>&detailid=<?php echo $result[0]; ?>" class="Detail">Details <i class="fa-solid fa-circle-info" style="color: #03a945;"></i></a>
                <a href="export_pdf_order.php?id=<?php echo $result[0]; ?>">Export PDF</a>
              </td>
            </tr>
      <?php }
            }
          } ?>
      </tbody>
      </table>
    </div>
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
</div>

<script>
  // bg_modal_box_order.addEventListener("click", function(event) {
  //   // Kiểm tra xem sự kiện click có xảy ra bên ngoài cửa sổ popup hay không
  //   if (event.target === bg_modal_box_order) {
  //     // Nếu có, đóng cửa sổ popup
  //     // modal.style.display = "none";
  //     modal_delete.classList.remove("active");
  //     bg_modal_box_order.classList.remove("active");
  //   }
  // });
  var bg_modal_box_order = document.querySelector(".bg-modal-box.order");

  var closeCurdDeleteModal = () => {
    let btn_add = document.querySelector('.bg-modal-box.order');
    btn_add.addEventListener("click", function() {
      modal_delete.classList.remove("active");
      bg_modal_box_order.classList.remove("active");
    });
  }
</script>

<script>
  $(document).ready(function() {
    $('.modal-btn-delete').click(function(e) {
      e.preventDefault();
      var delete_id = $(this).val();
      $('.delete_id').val(delete_id);
    });
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