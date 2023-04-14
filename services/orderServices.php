<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\helpers\\format.php";
?>

<?php class OrderServices
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function show_order()
  {
    $query = "SELECT * FROM orders ORDER BY id desc";
    $result = $this->db->select($query);
    return $result;
  }

  public function get_order_id()
  {
    $query = "SELECT * FROM orders ORDER BY id desc LIMIT 1";
    $result = $this->db->select($query);
    return $result;
  }

  public function insert_order($user_id, $total_quantity, $date, $total_price, $pay_method, $status, $is_deleted)
  {
    $query = "INSERT INTO orders(user_id, quantity, date, total_price, pay_method, status, is_deleted) VALUES ($user_id, $total_quantity, '$date', $total_price, '$pay_method', '$status', $is_deleted)";
    $result = $this->db->insert($query);
    if ($result) {
        return true;
    } else {
        return false;
    }
  }
}
?>
