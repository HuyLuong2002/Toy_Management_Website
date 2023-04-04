<?php

class DetailPermissionFunction
{
  private $conn;

  //category properties
  public $permission_id;
  public $function_id;
  public $action;
  //connect db
  public function __construct($db)
  {
    $this->conn = $db;
  }

  //read data
  public function read()
  {
    $query = "SELECT * FROM detail_permission_function";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  //show = get detail permission by permission_id
  public function show_detail_permission($id)
  {
    $query = "SELECT * FROM detail_permission_function where permission_id=? LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->permission_id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->function_id = $row["function_id"];
    $this->action = $row["action"];
  }

    //show = get detail function by function_id
  public function show_detail_function($id)
  {
    $query = "SELECT * FROM detail_permission_function where id=? LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->permission_id = $row["permission_id"];
    $this->action = $row["action"];
  }

  //create data
  public function create()
  {
    $query =
      "INSERT INTO orders(user_id, quantity, date, total_price, pay_method) VALUES(?,?,?,?,?)";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));
    $this->quantity = htmlspecialchars(strip_tags($this->quantity));
    $this->date = htmlspecialchars(strip_tags($this->date));
    $this->total_price = htmlspecialchars(strip_tags($this->total_price));
    $this->pay_method = htmlspecialchars(strip_tags($this->pay_method));
    //bind data
    $stmt->bindParam(1, $this->user_id);
    $stmt->bindParam(2, $this->quantity);
    $stmt->bindParam(3, $this->date);
    $stmt->bindParam(4, $this->total_price);
    $stmt->bindParam(5, $this->pay_method);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }

  //update data
  public function update($id)
  {
    $query =
      "UPDATE orders SET user_id=?, quantity=?, date=?, total_price=?, pay_method=? where id=?";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));
    $this->quantity = htmlspecialchars(strip_tags($this->quantity));
    $this->date = htmlspecialchars(strip_tags($this->date));
    $this->total_price = htmlspecialchars(strip_tags($this->total_price));
    $this->pay_method = htmlspecialchars(strip_tags($this->pay_method));

    //bind data
    $stmt->bindParam(1, $this->user_id);
    $stmt->bindParam(2, $this->quantity);
    $stmt->bindParam(3, $this->date);
    $stmt->bindParam(4, $this->total_price);
    $stmt->bindParam(5, $this->pay_method);
    $stmt->bindParam(6, $this->id);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }

  //delete data
  public function delete($id)
  {
    $query = "DELETE FROM orders where id=?";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    //bind data
    $stmt->bindParam(1, $this->id);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }
}
?>
