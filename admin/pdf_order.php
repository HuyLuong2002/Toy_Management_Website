<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/database/connectDB.php";
include_once $filepath . "/controller/ordersController.php";
include_once $filepath . "/controller/detail_orderController.php";
include_once $filepath . "/lib/session.php";
include_once $filepath . "/helpers/format.php";
require_once "./pdf_generator.php";
class PDFOrder
{
  private $order_id;

  public function __construct($id)
  {
    $this->order_id = $id;
  }

  public function export()
  {
    // create new PDFGenerator instance
    $fm = new Format();
    $pdfGenerator = new PDFGenerator();
    $orderController = new OrderController();
    $detail_orderController = new DetailOrderController();
    $result_order = $orderController
      ->show_orders_to_export($this->order_id)
      ->fetch_array();
    $result_detail_order = $detail_orderController->show_detail_order_to_export(
      $this->order_id
    );

    date_default_timezone_set("Asia/Ho_Chi_Minh");
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
    $pdfGenerator->setFont("dejavusans", "", 7);
    $pdfGenerator->formatText(0, 5, "Toy Shop", 0, 1, "L");
    $pdfGenerator->formatText(
      0,
      5,
      "Địa chỉ: 153 Ngô Quyền P14. Q8",
      0,
      1,
      "L"
    );
    $pdfGenerator->formatText(0, 5, "Hotline: 1900188628", 0, 1, "L");
    $pdfGenerator->setFont("dejavusans", "B", 11);
    // write content
    $pdfGenerator->formatText(0, 0, "Hóa đơn bán hàng", 0, 1, "C");
    // write customer and order information
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
      0
    );
    $pdfGenerator->formatTextDistance(
      40,
      5,
      "Ngày sinh: " . $result_order["date_birth"],
      0
    );
    $pdfGenerator->enterLine();
    $pdfGenerator->formatText(0, 5, "Địa chỉ: " . $result_order["address"], 0, 1, "L");
    $pdfGenerator->formatText(0, 5, "Số điện thoại: " . $result_order["phone"], 0, 1, "L");
    $pdfGenerator->formatText(0, 5, "Email: " . $result_order["email"], 0, 1, "L");

    $pdfGenerator->formatTextDistance(
      50,
      5,
      "Ngày đặt: " . $result_order["date"],
      0
    );
    $pdfGenerator->formatTextDistance(50, 5, "Ngày xuất: " . $export_date, 0);
    $pdfGenerator->enterLine();
    //write table title
    $pdfGenerator->setFont("dejavusans", "B", 7);
    $pdfGenerator->formatText(5, 0, "TT", 1, 0, "C");
    $pdfGenerator->formatText(20, 0, "Mã hàng", 1, 0, "C");
    $pdfGenerator->formatText(25, 0, "Tên hàng", 1, 0, "C");
    $pdfGenerator->formatText(10, 0, "SL", 1, 0, "C");
    $pdfGenerator->formatText(20, 0, "Đơn giá", 1, 0, "C");
    $pdfGenerator->formatText(20, 0, "Thành tiền", 1, 0, "C");
    $pdfGenerator->formatText(10, 0, "VAT", 1, 0, "C");
    $pdfGenerator->formatText(20, 0, "Tổng tiền", 1, 0, "C");
    $pdfGenerator->enterLine();
    //write table content - product content
    $pdfGenerator->setFont("dejavusans", "", 5);
    //calculate value to set on table
    $total_quantity = 0;
    $total_money = 0;
    $sum_total_price = 0;
    $sum_vat = 0;
    for ($i = 0; $i < $result_detail_order->num_rows; $i++) {
      $result = $result_detail_order->fetch_array();
      $pdfGenerator->formatText(5, 5, $i + 1, 1, 0, "C");
      $pdfGenerator->formatText(20, 5, $result["product_id"], 1, 0, "L");
      $pdfGenerator->formatText(25, 5, $result["name"], 1, 0, "L");
      $pdfGenerator->formatText(10, 5, $result[3], 1, 0, "C");
      $price = $fm->formatPriceDecimal($result[4]);
      $total_quantity = $total_quantity + $result[3];
      $pdfGenerator->formatText(20, 5, $price, 1, 0, "R");
      $into_money = $result[3] * $result[4];
      $total_money = $total_money + $into_money; // Tính tổng thành tiền
      $vat = 10;
      $sum_vat = $sum_vat + $vat;
      $total_price = $into_money + ($into_money * $vat) / 100;
      $sum_total_price = $sum_total_price + $total_price; // Tính tổng cột tổng tiền
      $into_money = $fm->formatPriceDecimal($into_money);
      $total_price = $fm->formatPriceDecimal($total_price);
      $pdfGenerator->formatText(20, 5, $into_money, 1, 0, "R");
      $pdfGenerator->formatText(10, 5, $vat, 1, 0, "C");
      $pdfGenerator->formatText(20, 5, $total_price, 1, 0, "R");
      $pdfGenerator->enterLine();
    }

    //write total price of per column
    $pdfGenerator->setFont("dejavusans", "B", 5);
    $pdfGenerator->formatText(50, 5, "Tổng tiền", 1, 0, "C");
    $pdfGenerator->formatText(10, 5, $total_quantity, 1, 0, "C");
    $pdfGenerator->formatText(20, 5, "", 1, 0, "");
    $total_money = $fm->formatPriceDecimal($total_money);
    $pdfGenerator->formatText(20, 5, $total_money, 1, 0, "R");
    $sum_vat = $fm->formatPriceDecimal($sum_vat);
    $pdfGenerator->formatText(10, 5, $sum_vat, 1, 0, "C");
    $sum_total_price = $fm->formatPriceDecimal($sum_total_price);
    $pdfGenerator->formatText(20, 5, $sum_total_price, 1, 0, "R");
    $pdfGenerator->enterLine();
    $pdfGenerator->enterLine();
    //write payment information
    $pdfGenerator->setFont("dejavusans", "", 5);
    $pdfGenerator->formatTextDistance(
      40,
      5,
      "Hình thức thanh toán: " . $result_order["pay_method"],
      0
    );
    $pdfGenerator->formatTextDistance(
      45,
      5,
      "Đã thanh toán: " . $sum_total_price,
      0
    );
    $pdfGenerator->enterLine();
    //write signature information
    $pdfGenerator->setFont("dejavusans", "B", 5);
    $pdfGenerator->formatText(50, 2, "Thu ngân", 0, 0, "C");
    $pdfGenerator->formatText(50, 2, "Khách hàng", 0, 0, "C");
    $pdfGenerator->enterLine();
    $pdfGenerator->setFont("dejavusans", "", 5);
    $pdfGenerator->formatText(50, 3, "(Ký, ghi rõ họ tên)", 0, 0, "C");
    $pdfGenerator->formatText(50, 3, "(Ký, ghi rõ họ tên)", 0, 0, "C");
    $pdfGenerator->enterLine();
    $pdfGenerator->enterLine();
    $pdfGenerator->enterLine();
    $pdfGenerator->enterLine();
    $pdfGenerator->setFont("dejavusans", "B", 5);
    $pdfGenerator->formatText(130, 0, "Cảm ơn quý khách!", 0, 0, "C");
    // output PDF as a file
    // generate random filename using time and uniqid without dot
    $filename = "./export/" . str_replace(".", "", uniqid("", true)) . ".pdf";
    $pdfGenerator = $pdfGenerator->outputFile($filename);
  }
}
?>
