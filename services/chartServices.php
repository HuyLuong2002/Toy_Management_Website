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

  public function show_best_selling_products($startDate, $endDate)
  {
    $query = "SELECT product.name AS product_name, SUM(detail_orders.quantity) AS total_sales
    FROM detail_orders, orders, product
    WHERE orders.date BETWEEN '{$startDate}' AND '{$endDate} 23:59:59' AND detail_orders.order_id = orders.id AND product.id = detail_orders.product_id
    GROUP BY product_id
    ORDER BY total_sales DESC
    LIMIT 5";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_revenue_quarter($year)
  {
    $query = "
    SELECT 
      YEAR(STR_TO_DATE(orders.date, '%Y-%m-%d')) AS Nam,
      QUARTER(STR_TO_DATE(orders.date, '%Y-%m-%d')) AS Quy,
      SUM(orders.total_price) AS DoanhThu
    FROM 
        orders
    WHERE 
        YEAR(STR_TO_DATE(orders.date, '%Y-%m-%d')) = {$year}
    GROUP BY 
        YEAR(STR_TO_DATE(orders.date, '%Y-%m-%d')),
        QUARTER(STR_TO_DATE(orders.date, '%Y-%m-%d'))
    ORDER BY 
        YEAR(STR_TO_DATE(orders.date, '%Y-%m-%d')),
        QUARTER(STR_TO_DATE(orders.date, '%Y-%m-%d'));
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
      "SELECT YEAR(STR_TO_DATE(orders.date, '%Y-%m-%d')) 
      AS Nam, MONTH(STR_TO_DATE(orders.date, '%Y-%m-%d')) 
      AS Thang, SUM(orders.total_price) AS DoanhThu 
      FROM orders 
      WHERE YEAR(STR_TO_DATE(orders.date, '%Y-%m-%d')) <= {$year2} 
      AND YEAR(STR_TO_DATE(orders.date, '%Y-%m-%d')) >= {$year1} 
      GROUP BY YEAR(STR_TO_DATE(orders.date, '%Y-%m-%d')), MONTH(STR_TO_DATE(orders.date, '%Y-%m-%d')) 
      ORDER BY YEAR(STR_TO_DATE(orders.date, '%Y-%m-%d')), MONTH(STR_TO_DATE(orders.date, '%Y-%m-%d'))";

    $result = $this->db->select($query);
    return $result;
  }
}
?>
