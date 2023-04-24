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
      <div class="order-detail">
          <p class="product-id">
            Product ID:
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
    <div class="orders-actions">
      <button class="delete-button"><a
          href="orders_detail.php?id=${data.order_id}&deleteid=${data.id}">Delete</a></button>
    </div>
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