<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\helpers\\format.php";
?>

<?php class DetailOrder
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function show_detail_order()
  {
    $query = "SELECT * FROM detail_orders ORDER BY id desc";
    $result = $this->db->select($query);
    return $result;
  }

  public function insert_detail_order($order_id, $product_id, $quantity, $price)
  {
    $query = "INSERT INTO detail_orders(order_id, product_id, quantity, price) VALUES ($order_id, $product_id, $quantity, $price)";
    $result = $this->db->insert($query);
    if ($result) {
        return true;
    } else {
        return false;
    }
  }
}
?>
