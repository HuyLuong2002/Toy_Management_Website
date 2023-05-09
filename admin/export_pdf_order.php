<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\admin\pdf_order.php";
if (isset($_GET["id"])) {
  $order_id = $_GET["id"];
}
$pdfOrder = new PDFOrder($order_id);
$pdfOrder->export();
// header("Location: index.php?id=3&page=1");
?>
