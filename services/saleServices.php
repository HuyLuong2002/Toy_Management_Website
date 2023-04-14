<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";

?>

<?php class SaleServices
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function show_sale()
  {
    $query = "SELECT * FROM sale ORDER BY id desc";
    $result = $this->db->select($query);
    return $result;
  }
}
?>
