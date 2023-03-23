<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\helpers\\format.php";
?>

<?php class Product
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function show_product_user()
  {
    $query = "SELECT * FROM product, category, sale WHERE product.category_id = category.id and product.sale_id = sale.id
      ORDER BY product.create_date DESC";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product()
  {
    $query = "SELECT * FROM product";
    $result = $this->db->select($query);
    return $result;
  }
}
?>
