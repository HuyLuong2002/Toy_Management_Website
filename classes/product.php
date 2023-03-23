<?php
include_once "database/connectDB.php";
include_once "helpers/format.php";
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

  public function show_product()
  {
    $query =
      "SELECT * FROM product, category, sale WHERE product.category_id = category.id and product.sale_id = sale.id
      ORDER BY product.id DESC";
    $result = $this->db->select($query);
    return $result;
  }
}
?>
