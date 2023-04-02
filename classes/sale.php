<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\helpers\\format.php";
?>

<?php class Sale
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function show_sale()
  {
    $query = "SELECT * FROM sale ORDER BY id desc";
    $result = $this->db->select($query);
    return $result;
  }
}
?>
