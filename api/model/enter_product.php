<?php

class EnterProduct
{
  private $conn;

  //category properties
  public $id;
  public $enter_date;
  public $total_quantity;
  public $total_price;
  public $provider_id;
  public $user_id;
  public $status;
  public $create_date;


  //connect db
  public function __construct($db)
  {
    $this->conn = $db;
  }

  //read data
  public function read()
  {
    $query = "SELECT * FROM enter_product";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  //show = get category by id
  public function show($id)
  {
    $query = "SELECT * FROM enter_product where id=? LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->enter_date = $row["enter_date"];
    $this->total_quantity = $row["total_quantity"];
    $this->total_price = $row["total_price"];
    $this->provider_id = $row["provider_id"];
    $this->user_id = $row["user_id"];
    $this->status = $row["status"];
    $this->create_date = $row["create_date"];
  }

  //create data
  public function create()
  {
    $query =
      "INSERT INTO enter_product(enter_date, total_quantity, total_price, provider_id, user_id, status, create_date) VALUES(?,?,?,?,?,?,?)";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->enter_date = htmlspecialchars(strip_tags($this->enter_date));
    $this->total_quantity = htmlspecialchars(strip_tags($this->total_quantity));
    $this->total_price = htmlspecialchars(strip_tags($this->total_price));
    $this->provider_id = htmlspecialchars(strip_tags($this->provider_id));
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));
    $this->status = htmlspecialchars(strip_tags($this->status));
    $this->create_date = htmlspecialchars(strip_tags($this->create_date));
    //bind data
    $stmt->bindParam(1, $this->enter_date);
    $stmt->bindParam(2, $this->total_quantity);
    $stmt->bindParam(3, $this->total_price);
    $stmt->bindParam(4, $this->provider_id);
    $stmt->bindParam(5, $this->user_id);
    $stmt->bindParam(6, $this->status);
    $stmt->bindParam(7, $this->create_date);

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
      "UPDATE enter_product SET enter_date=?, total_quantity=?, total_price=?, provider_id=?, user_id=?, status=?, create_date=? where id=?";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->enter_date = htmlspecialchars(strip_tags($this->enter_date));
    $this->total_quantity = htmlspecialchars(strip_tags($this->total_quantity));
    $this->total_price = htmlspecialchars(strip_tags($this->total_price));
    $this->provider_id = htmlspecialchars(strip_tags($this->provider_id));
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));
    $this->status = htmlspecialchars(strip_tags($this->status));
    $this->create_date = htmlspecialchars(strip_tags($this->create_date));

    //bind data
    $stmt->bindParam(1, $this->enter_date);
    $stmt->bindParam(2, $this->total_quantity);
    $stmt->bindParam(3, $this->total_price);
    $stmt->bindParam(4, $this->provider_id);
    $stmt->bindParam(5, $this->user_id);
    $stmt->bindParam(6, $this->status);
    $stmt->bindParam(7, $this->create_date);
    $stmt->bindParam(8, $this->id);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }

  //delete data
  public function delete($id)
  {
    $query = "DELETE FROM enter_product where id=?";
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
