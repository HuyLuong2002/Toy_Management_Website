<?php

class DetailOrders
{
  private $conn;

  //category properties
  public $id;
  public $order_id;
  public $product_id;
  public $quantity;
  public $price;
  //connect db
  public function __construct($db)
  {
    $this->conn = $db;
  }

  //read data
  public function read()
  {
    $query = "SELECT * FROM detail_orders";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  //show = get detail permission by permission_id
  public function show_detail_product($product_id)
  {
    $query = "SELECT * FROM detail_orders where product_id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->product_id);
    $stmt->execute();

    return $stmt;
  }

  //show = get detail function by function_id
  public function show_detail_order()
  {
    $query = "SELECT detail_orders.*, orders.date, product.name, product.image FROM detail_orders, product, orders where order_id=? AND detail_orders.product_id = product.id AND detail_orders.order_id = orders.id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->order_id);
    $stmt->execute();

    return $stmt;
  }

  //create data
  public function create()
  {
    $query =
      "INSERT INTO detail_permission_function(permission_id, function_id, action) VALUES(?,?,?)";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->permission_id = htmlspecialchars(strip_tags($this->permission_id));
    $this->function_id = htmlspecialchars(strip_tags($this->function_id));
    $this->action = htmlspecialchars(strip_tags($this->action));

    //bind data
    $stmt->bindParam(1, $this->permission_id);
    $stmt->bindParam(2, $this->function_id);
    $stmt->bindParam(3, $this->action);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }

  //update data
  public function update()
  {
    $query =
      "UPDATE detail_permission_function SET action=? where permission_id=? and function_id=? and id=?";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->permission_id = htmlspecialchars(strip_tags($this->permission_id));
    $this->function_id = htmlspecialchars(strip_tags($this->function_id));
    $this->action = htmlspecialchars(strip_tags($this->action));

    //bind data
    $stmt->bindParam(1, $this->action);
    $stmt->bindParam(2, $this->permission_id);
    $stmt->bindParam(3, $this->function_id);
    $stmt->bindParam(4, $this->id);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }

  //delete data
  public function delete()
  {
    $query = "DELETE FROM detail_permission_function where permission_id=? and function_id=? and id=?";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->permission_id = htmlspecialchars(strip_tags($this->permission_id));
    $this->function_id = htmlspecialchars(strip_tags($this->function_id));
    $this->id = htmlspecialchars(strip_tags($this->id));

    //bind data
    $stmt->bindParam(1, $this->permission_id);
    $stmt->bindParam(2, $this->function_id);
    $stmt->bindParam(3, $this->id);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }
}
?>
