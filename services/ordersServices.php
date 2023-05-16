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

  public function show_selling_product($startDate, $endDate)
  {
    $query = "SELECT orders.*, account.username FROM detail_orders, orders, product, account
    WHERE orders.date BETWEEN '{$startDate}' AND '{$endDate} 23:59:59' 
    AND detail_orders.order_id = orders.id 
    AND product.id = detail_orders.product_id
    AND account.id = orders.user_id
    GROUP BY orders.id";
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
    $query = "SELECT * FROM orders, account WHERE orders.is_deleted = '0' and orders.user_id = account.id ORDER BY orders.date DESC, orders.status DESC";
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
    $query = "SELECT * FROM orders, account WHERE orders.is_deleted = '0' and orders.user_id = account.id ORDER BY orders.date DESC LIMIT $offset, $limit_per_page";
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
    $query = "SELECT * FROM orders WHERE ((orders.user_id LIKE '%$input%') 
    OR (orders.quantity LIKE '%$input%') 
    OR (orders.date LIKE '%$input%') 
    OR (orders.address LIKE '%$input%') 
    OR (orders.phone LIKE '%$input%') 
    OR (orders.email LIKE '%$input%') 
    OR (orders.country LIKE '%$input%')
    OR (orders.vat LIKE '%$input%')
    OR (orders.ship_method LIKE '%$input%')
    OR (orders.total_price LIKE '%$input%') 
    OR (orders.pay_method LIKE '%$input%') 
    OR (orders.status LIKE '%$input%'))  AND is_deleted = '0'";
    $result = $this->db->select($query);
    return $result;
  }

  public function insert_order(
    $user_id,
    $total_quantity,
    $date,
    $address,
    $phone,
    $email,
    $country,
    $vat,
    $ship_method,
    $total_price,
    $pay_method,
    $status,
    $is_deleted
  ) {
    $query = "INSERT INTO orders(user_id, quantity, date, address, phone, email, country, vat, ship_method, total_price, pay_method, status, is_deleted) VALUES ('$user_id', '$total_quantity', '$date', '$address', '$phone', '$email', '$country', '$vat', '$ship_method', '$total_price', '$pay_method', '$status', '$is_deleted')";
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

  public function update_status_order($data)
  {
    $status = mysqli_real_escape_string($this->db->link, $data["status"]);
    $id = mysqli_real_escape_string($this->db->link, $data["id_order"]);
    // $status = $data["status"];
    $query = "UPDATE orders SET status='{$status}' WHERE id='{$id}'";
    $result = $this->db->update($query);
    return $result;
  }
}

?>
