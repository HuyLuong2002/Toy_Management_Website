<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\lib\session.php";
include_once $filepath . "\helpers\\format.php";
Session::init();

class InventoryServices
{
  private $db;
  private $fm;
  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function show_inventory()
  {
    $query = "SELECT enter_product.*, provider.name, account.firstname, account.lastname FROM enter_product, provider, account WHERE enter_product.provider_id = provider.id AND enter_product.user_id = enter_product.user_id AND enter_product.is_deleted = 0
      GROUP BY enter_product.id";
    $result = $this->db->select($query);
    return $result;
  }

  public function get_inventory_by_id($id)
  {
    $query = "SELECT * FROM enter_product WHERE enter_product.id = {$id}";
    $result = $this->db->select($query);
    return $result;
  }

  public function get_detail_inventory_by_id($id)
  {
    $query = "SELECT * FROM detail_enter_product WHERE detail_enter_product.id = {$id}";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_inventory_by_pagination($offset, $limit_per_page){
    $query = "SELECT enter_product.*, provider.name, account.firstname, account.lastname FROM enter_product, provider, account 
    WHERE enter_product.provider_id = provider.id AND enter_product.user_id = enter_product.user_id 
    AND enter_product.is_deleted = 0 GROUP BY enter_product.id 
    LIMIT $offset, $limit_per_page";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_inventory_detail_by_pagination($offset, $limit_per_page, $enter_id)
  {
    $query = "SELECT detail_enter_product.*, product.name FROM detail_enter_product, product WHERE enter_id = {$enter_id} 
    AND product.id = detail_enter_product.product_id LIMIT $offset, $limit_per_page";
    $result = $this->db->select($query);
    return $result;
  }

  public function update_inventory($data, $id)
  {
    $enter_date = $this->fm->formatDate($data["enter-date"]);

    $total_quantity = mysqli_real_escape_string(
      $this->db->link,
      $data["total-quantity"]
    );
    $total_price = mysqli_real_escape_string(
      $this->db->link,
      $data["total-price"]
    );
    $provider_id = mysqli_real_escape_string(
      $this->db->link,
      $data["provider"]
    );
    $user_id = Session::get("userID");
    $status = mysqli_real_escape_string($this->db->link, $data["status"]);
    $create_date = (string) date("d/m/Y");

    $query = "UPDATE enter_product SET enter_date='{$enter_date}', total_quantity={$total_quantity}, total_price={$total_price}, provider_id={$provider_id}, user_id={$user_id}, status={$status}, create_date='{$create_date}' WHERE id = {$id}";
    $result = $this->db->update($query);
    if ($result) {
      $alert = "<span class='success'>Update Receipt Sucessfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Update Receipt Not Sucessfully</span>";
      return $alert;
    }
  }

  public function insert_inventory($data)
  {
    $enter_date = $this->fm->formatDate($data["enter-date"]);

    $total_quantity = mysqli_real_escape_string(
      $this->db->link,
      $data["total-quantity"]
    );
    $total_price = mysqli_real_escape_string(
      $this->db->link,
      $data["total-price"]
    );
    $provider_id = mysqli_real_escape_string(
      $this->db->link,
      $data["provider"]
    );
    $user_id = Session::get("userID");
    $status = mysqli_real_escape_string($this->db->link, $data["status"]);
    $create_date = (string) date("d/m/Y");

    $query = "INSERT INTO enter_product(enter_date, total_quantity, total_price, provider_id, user_id, status, create_date, is_deleted) VALUES ('$enter_date',$total_quantity,$total_price,$provider_id,$user_id,$status,'$create_date',0)";
    $result = $this->db->insert($query);
    if ($result) {
      $alert = "<span class='success'>Insert Receipt Sucessfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Insert Receipt Not Sucessfully</span>";
      return $alert;
    }
  }

  public function delete_inventory($id)
  {
    $query = "UPDATE enter_product SET is_deleted='1' WHERE id='$id'";
    $result = $this->db->update($query);
    if ($result) {
      $alert = "<span class='success'>Receipt Deleted Sucessfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Receipt Delete Not Sucessfully</span>";
      return $alert;
    }
  }

  public function show_inventory_detail($enter_id)
  {
    $query = "SELECT detail_enter_product.*, product.name FROM detail_enter_product, product WHERE enter_id = {$enter_id} AND product.id = detail_enter_product.product_id";
    $result = $this->db->select($query);
    return $result;
  }

  public function insert_inventory_detail($data)
  {
    $enter_id = mysqli_real_escape_string(
      $this->db->link,
      $data["enter-id"]
    );

    $product_id = mysqli_real_escape_string(
      $this->db->link,
      $data["product"]
    );
    $quantity = mysqli_real_escape_string(
      $this->db->link,
      $data["quantity"]
    );
    $price = mysqli_real_escape_string(
      $this->db->link,
      $data["price"]
    );

    $query = "INSERT INTO detail_enter_product(enter_id, product_id, quantity, price) VALUES ($enter_id,$product_id,$quantity,$price)";
    $result = $this->db->insert($query);
    if ($result) {
      $alert = "<span class='success'>Insert Receipt Detail Sucessfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Insert Receipt Detail Not Sucessfully</span>";
      return $alert;
    }
  }

  public function update_inventory_detail($data, $id)
  {
    $enter_id = mysqli_real_escape_string(
      $this->db->link,
      $data["enter-id"]
    );
    $product_id = mysqli_real_escape_string(
      $this->db->link,
      $data["product"]
    );
    $quantity = mysqli_real_escape_string(
      $this->db->link,
      $data["quantity"]
    );
    $price = mysqli_real_escape_string(
      $this->db->link,
      $data["price"]
    );

    $query = "UPDATE detail_enter_product SET enter_id='{$enter_id}', product_id={$product_id}, quantity={$quantity}, price={$price} WHERE id = {$id}";
    $result = $this->db->update($query);
    if ($result) {
      $alert = "<span class='success'>Update Receipt Detail Sucessfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Update Receipt Detail Not Sucessfully</span>";
      return $alert;
    }
  }

  public function delete_inventory_detail($id)
  {
    $query = "DELETE FROM detail_enter_product WHERE id={$id}";
    $result = $this->db->delete($query);
    if ($result) {
      $alert = "<span class='success'>Receipt Deleted Sucessfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Receipt Delete Not Sucessfully</span>";
      return $alert;
    }
  }
}
?>
