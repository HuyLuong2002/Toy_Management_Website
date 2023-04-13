<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\helpers\\format.php";
?>

<?php class Dashboard
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function show_statistic_product()
  {
    $query = "SELECT COUNT(*) FROM product WHERE is_deleted = '0'";
    $result = $this->db->select($query);
    return $result;
  }
}
?>
