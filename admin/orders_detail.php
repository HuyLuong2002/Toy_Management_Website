<div class="orders-details" id="orders-details">
  <?php
  $show_detail_order = $detailOrderController->show_detail_order_by_id($_GET["detailid"]);
  if ($show_detail_order) {
    $result = $show_detail_order->fetch_array(); ?>
    <div class="orders-info">
      <h2 class="orders-id">
        Order ID:
        <?php echo $result[1] ?>
      </h2>
      <div class="order-detail" style="font-weight: bold">
        <p class="product-id">
          Product ID:
        </p>
        <p class="product-name">
          Product name:
        </p>
        <p class="product-quantity">
          Quantity:
        </p>
        <p class="product-price">
          Price:
        </p>

      </div>
    <?php } ?>
    <?php
    $show_detail_order = $detailOrderController->show_detail_order_by_id($_GET["detailid"]);
    if ($show_detail_order) {
      while ($result = $show_detail_order->fetch_array()) { ?>

        <div class="order-detail">
          <p class="product-id">
            <?php echo $result[2] ?>
          </p>
          <p class="product-name">
            <?php echo $result[20] ?>
          </p>
          <p class="product-quantity">
            <?php echo $result[3] ?>
          </p>

          <p class="product-price">
            <?php echo $result[4] ?>
          </p>

        </div>

      <?php }
    }
    ?>
    <?php
    $show_detail_order = $detailOrderController->show_detail_order_by_id($_GET["detailid"]);
    if ($show_detail_order) {
      $result = $show_detail_order->fetch_array() ?>
      <div class="order-detail-info">
        <p class="product-d">
          Address:
        </p>
        <?php echo $result[9] ?>
        <br>
        <p class="product-d">
          VAT:
        </p>
        <?php echo $result[13] ?>
        <br>

        <p class="product-d">
          Ship method:
        </p>
        <?php echo $result[14] ?>
        <br>

        <p class="product-d">
          Payment method:
        </p>
        <?php echo $result[16] ?>
        <br>

        <p class="product-d">
          Total Price:
        </p>
        <?php echo $result[15] ?>
        <br>

      </div>
    <?php }

    ?>
    <div class="close-icon" onclick="handleClose()">
      X
    </div>
  </div>
</div>

<script>
  // CloseOrderDetail
  const handleClose = () => {
    const layout = document.getElementById("orders-details")
    layout.style.display = "none";
  }
</script>