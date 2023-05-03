<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
?>

<?php class DetailOrderServices
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function show_detail_order()
  {
    $query = "SELECT * FROM detail_orders ORDER BY id desc";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_detail_order_by_id($id)
  {
    $query = "SELECT * FROM detail_orders WHERE order_id = {$id}";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_detail_order_to_export($id)
  {
    $query = "SELECT * FROM detail_orders, product WHERE order_id = $id AND product.id = detail_orders.product_id";
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

  public function delete_detail_orders($id)
  {
    $query = "DELETE FROM detail_orders WHERE id='$id'";
    $result = $this->db->delete($query);
    if ($result) {
      $alert = "<span class='success'>detail_orders Deleted Sucessfully</span>";
      return $alert;
    } else {
      $alert =
        "<span class='error'>detail_orders Delete Not Sucessfully</span>";
      return $alert;
    }
  }
}
?>
