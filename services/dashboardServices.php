<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
?>

<?php class DashboardServices
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function show_statistic_product()
  {
    $query = "SELECT COUNT(*) FROM product WHERE is_deleted = '0'";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_statistic_orders()
  {
    $query = "SELECT COUNT(*) FROM orders WHERE is_deleted = '0'";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_orders()
  {
    $query = "SELECT * FROM orders WHERE is_deleted = '0'";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_statistic_customer()
  {
    $query = "SELECT COUNT(*) FROM account WHERE is_deleted = '0' AND status = '1' AND permission_id = '2'";
    $result = $this->db->select($query);
    return $result;
  }
}
?>
