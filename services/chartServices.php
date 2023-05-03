<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";

class ChartServices
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function show_revenue_quarter($year)
  {
    $query = "
    SELECT 
      YEAR(STR_TO_DATE(orders.date, '%d/%m/%Y')) AS Nam,
      QUARTER(STR_TO_DATE(orders.date, '%d/%m/%Y')) AS Quy,
      SUM(orders.total_price) AS DoanhThu
    FROM 
        orders
    WHERE 
        YEAR(STR_TO_DATE(orders.date, '%d/%m/%Y')) = {$year}
    GROUP BY 
        YEAR(STR_TO_DATE(orders.date, '%d/%m/%Y')),
        QUARTER(STR_TO_DATE(orders.date, '%d/%m/%Y'))
    ORDER BY 
        YEAR(STR_TO_DATE(orders.date, '%d/%m/%Y')),
        QUARTER(STR_TO_DATE(orders.date, '%d/%m/%Y'));
    ";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_statistic_order()
  {
    $query = "SELECT status AS TinhTrangDonHang, COUNT(*) AS SoLuongHoaDon FROM orders WHERE orders.is_deleted = 0 
    GROUP BY orders.status";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_statistic_revenue_by_month($year1, $year2)
  {
    
    $query =
      "SELECT YEAR(STR_TO_DATE(orders.date, '%d/%m/%Y')) 
      AS Nam, MONTH(STR_TO_DATE(orders.date, '%d/%m/%Y')) 
      AS Thang, SUM(orders.total_price) AS DoanhThu 
      FROM orders 
      WHERE YEAR(STR_TO_DATE(orders.date, '%d/%m/%Y')) <= {$year2} 
      AND YEAR(STR_TO_DATE(orders.date, '%d/%m/%Y')) >= {$year1} 
      GROUP BY YEAR(STR_TO_DATE(orders.date, '%d/%m/%Y')), MONTH(STR_TO_DATE(orders.date, '%d/%m/%Y')) 
      ORDER BY YEAR(STR_TO_DATE(orders.date, '%d/%m/%Y')), MONTH(STR_TO_DATE(orders.date, '%d/%m/%Y'))";

    $result = $this->db->select($query);
    return $result;
  }
}
?>
