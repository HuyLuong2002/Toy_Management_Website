<?php

class Order
{
  private $conn;

  //category properties
  public $id;
  public $user_id;
  public $quantity;
  public $date;
  public $address;
  public $phone;
  public $email;
  public $country;
  
  public $status;
  public $total_price;
  public $pay_method;

  //connect db
  public function __construct($db)
  {
    $this->conn = $db;
  }

  //read data
  public function read()
  {
    $query = "SELECT * FROM orders";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  //show = get category by id
  public function show($id)
  {
    $query = "SELECT * FROM orders where id=? LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->user_id = $row["user_id"];
    $this->quantity = $row["quantity"];
    $this->date = $row["date"];
    $this->total_price = $row["total_price"];
    $this->pay_method = $row["pay_method"];
  }

  public function show_user()
  {
    $query = "SELECT * FROM orders where user_id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->user_id);
    $stmt->execute();
    return $stmt;
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
