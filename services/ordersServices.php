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

  //list orders for home page
  public function show_orders_user()
  {
    $query = "SELECT * FROM orders WHERE is_deleted = '0'";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_orders_to_export($id)
  {
    $query = "SELECT * FROM orders, account WHERE orders.id = {$id} AND orders.user_id = account.id";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_order_by_pagination($offset, $limit_per_page)
  {
    $query = "SELECT * FROM orders WHERE is_deleted = '0' LIMIT $offset, $limit_per_page";
    $result = $this->db->select($query);
    return $result;
  }

  public function get_orders_by_id($id)
  {
    $query = "SELECT * FROM orders WHERE id = '{$id}'";
    $result = $this->db->select($query);
    return $result;
  }

  //live search for admin
  public function show_orders_live_search($input)
  {
    $query = "SELECT * FROM orders WHERE ((orders.user_id LIKE '$input%') OR (orders.quantity LIKE '$input%') OR 
    (orders.date LIKE '$input%') OR (orders.total_price LIKE '$input%') OR (orders.pay_method LIKE '$input%') OR (orders.status LIKE '$input%'))";
    $result = $this->db->select($query);
    return $result;
  }

  public function insert_order(
    $user_id,
    $total_quantity,
    $date,
    $total_price,
    $pay_method,
    $status,
    $is_deleted
  ) {
    $query = "INSERT INTO orders(user_id, quantity, date, total_price, pay_method, status, is_deleted) VALUES ($user_id, $total_quantity, '$date', $total_price, '$pay_method', '$status', $is_deleted)";
    $result = $this->db->insert($query);
    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  public function delete_orders($id)
  {
    $query = "UPDATE orders SET is_deleted='1' WHERE id='$id'";
    $result = $this->db->update($query);
    if ($result) {
      $alert = "<span class='success'>Orders Deleted Sucessfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Orders Delete Not Sucessfully</span>";
      return $alert;
    }
  }
}

?>
