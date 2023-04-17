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
}
?>
