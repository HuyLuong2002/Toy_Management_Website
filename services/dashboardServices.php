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
}
?>
