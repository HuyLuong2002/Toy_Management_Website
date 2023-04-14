<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
?>

<?php class CategoryServices
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function show_category()
  {
    $query = "SELECT * FROM category ORDER BY id desc";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_category_by_id($category_id)
  {
    $query = "SELECT * FROM category WHERE id = '$category_id'";
    $result = $this->db->select($query);
    return $result;
  }
}
?>
