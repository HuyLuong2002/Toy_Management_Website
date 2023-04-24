<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\controller\ordersController.php";
$orderController = new OrderController();

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_orders_live_search = $orderController->show_orders_live_search($input);
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["deleteid"])) {
  $delete_id = $_GET["deleteid"];
  $delete_orders = $orderController->delete_orders($delete_id);
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
          </tr>
        </thead>
        <tbody>
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
                  <td><a href="?id=3&deleteid=<?php echo $result[0]; ?>">Delete</a> | <a
                      href="orders_detail.php?id=<?php echo $result[0]; ?>">Details</a> </td>
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
        <tbody>
          <?php
          $show_orders = $orderController->show_orders_user();
          if ($show_orders) {
            while ($result = $show_orders->fetch_array()) { ?>
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
                <td><a href="?id=3&deleteid=<?php echo $result[0]; ?>">Delete</a> | <a
                    href="orders_detail.php?id=<?php echo $result[0]; ?>">Details</a> </td>
              </tr>
            <?php }
          }
          } ?>
      </tbody>
      </table>
    </div>
  </div>
</div>