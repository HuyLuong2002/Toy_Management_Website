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

if (isset($_GET["deleteid"])) {
  $delete_id = $_GET["deleteid"];
  $delete_orders = $orderController->delete_orders($delete_id);
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
    <h3>Orders List</h3>
    <?php

    if (isset($delete_orders)) {
      echo $delete_orders;
    }
    ?>
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
            <td>Total price</td>
            <td>Payment method</td>
            <td>Status</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody id="product-data">
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
                    <?php echo $result[6] == 1 ? "Đã giao" : "Đang giao hàng"; ?>
                  </td>
                  <td>
                    <a href="?id=3&deleteid=<?php echo $result[0]; ?>" class="Delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
                    <a href="orders_detail.php?id=<?php echo $result[0]; ?>" class="Detail">Details <i class="fa-solid fa-circle-info" style="color: #03a945;"></i></a>
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
      <tbody id="product-data">
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
                <?php echo $result[6] == 1 ? "Đã giao" : "Đang giao hàng"; ?>
              </td>
              <td>
                <a href="?id=3&deleteid=<?php echo $result[0]; ?>" class="Delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
                <a href="?id=3&page=<?php echo $page_id?>&detailid=<?php echo $result[0]; ?>" class="Detail">Details <i class="fa-solid fa-circle-info" style="color: #03a945;"></i></a>
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
</div>

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