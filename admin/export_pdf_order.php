<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/database/connectDB.php";
include_once $filepath . "/controller/ordersController.php";
include_once $filepath . "/controller/detail_orderController.php";
include_once $filepath . "/lib/session.php";
require_once "./pdf_generator.php";

if ($_GET["id"]) {
  $order_id = $_GET["id"];
}
// create new PDFGenerator instance
$pdfGenerator = new PDFGenerator();
$orderController = new OrderController();
$detail_orderController = new DetailOrderController();
$result_order = $orderController
  ->show_orders_to_export($order_id)
  ->fetch_array();
$result_detail_order = $detail_orderController
  ->show_detail_order_to_export($order_id)
  ->fetch_array();

date_default_timezone_set('Asia/Ho_Chi_Minh');
$export_date = (string) date("d/m/Y H:i:s a");

// set document information
$pdfGenerator->setDocumentInformation(
  "Your Name",
  "Your Name",
  "Document Title",
  "Document Subject"
);

// add a page
$pdfGenerator->addPage();
// set font
$pdfGenerator->setFont("dejavusans", "B", 11);
// write content
$pdfGenerator->formatText(0, 0, "Hóa đơn bán hàng", 0, 1, "C");
// write customer information
$pdfGenerator->setFont("dejavusans", "", 7);
$pdfGenerator->writeText("Mã hóa đơn: " . $result_order[0]);
$pdfGenerator->enterLine();
$pdfGenerator->formatTextDistance(
  80,
  5,
  "Tên khách hàng: " .
    $result_order["firstname"] .
    " " .
    $result_order["lastname"],
  0, null
);
$pdfGenerator->formatTextDistance(
  40,
  5,
  "Ngày sinh: " . $result_order["date_birth"],
  0, null
);
$pdfGenerator->enterLine();
$pdfGenerator->formatTextDistance(
  40,
  5,
  "Ngày đặt: " . $result_order["date"],
  0, null
);
$pdfGenerator->formatTextDistance(40, 5, "Ngày xuất: " . $export_date, 0, null);
$pdfGenerator->enterLine();
$pdfGenerator->setFont("dejavusans", "B", 7);
$pdfGenerator->formatTextDistance(5, 5, "TT", 1, 'C');
$pdfGenerator->formatTextDistance(20, 5, "Mã hàng", 1, 'C');
$pdfGenerator->formatTextDistance(20, 5, "Tên hàng", 1, 'C');
$pdfGenerator->formatTextDistance(10, 5, "SL", 1, 'C');
$pdfGenerator->formatTextDistance(15, 5, "Đơn giá", 1, 'C');
$pdfGenerator->formatTextDistance(25, 5, "Thành tiền", 1, 'C');
$pdfGenerator->formatTextDistance(15, 5, "VAT", 1, 'C');
$pdfGenerator->formatTextDistance(25, 5, "Tổng tiền", 1, 'C');
$pdfGenerator->enterLine();
// output PDF as a file
// generate random filename using time and uniqid without dot
$filename = "./export/" . str_replace(".", "", uniqid("", true)) . ".pdf";
$pdfGenerator = $pdfGenerator->outputFile($filename);

header("Location: index.php?id=3&page=1");
?>
