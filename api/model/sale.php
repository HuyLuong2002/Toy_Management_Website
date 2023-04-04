<?php

class Sale
{
  private $conn;

  //category properties
  public $id;
  public $name;
  public $create_date;
  public $start_date;
  public $end_date;
  public $percent_sale;
  public $status;


  //connect db
  public function __construct($db)
  {
    $this->conn = $db;
  }

  //read data
  public function read()
  {
    $query = "SELECT * FROM sale";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  //show = get category by id
  public function show()
  {
    $query = "SELECT * FROM sale where id=? LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->name = $row["name"];
    $this->create_date = $row["create_date"];
    $this->start_date = $row["start_date"];
    $this->end_date = $row["end_date"];
    $this->percent_sale = $row["percent_sale"];
    $this->status = $row["status"];
  }

  //create data
  public function create()
  {
    $query = "INSERT INTO sale(name, create_date, start_date, end_date, percent_sale, status) VALUES (?,?,?,?,?,?)";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->create_date = htmlspecialchars(strip_tags($this->create_date));
    $this->start_date = htmlspecialchars(strip_tags($this->start_date));
    $this->end_date = htmlspecialchars(strip_tags($this->end_date));
    $this->percent_sale = htmlspecialchars(strip_tags($this->percent_sale));
    $this->status = htmlspecialchars(strip_tags($this->status));
    //bind data
    $stmt->bindParam(1, $this->name);
    $stmt->bindParam(2, $this->create_date);
    $stmt->bindParam(3, $this->start_date);
    $stmt->bindParam(4, $this->end_date);
    $stmt->bindParam(5, $this->percent_sale);
    $stmt->bindParam(6, $this->status);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }

  //update data
  public function update()
  {
    $query = "UPDATE sale SET name=?, create_date=?, start_date=?, end_date=?, percent_sale=?, status=? where id=?";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->create_date = htmlspecialchars(strip_tags($this->create_date));
    $this->start_date = htmlspecialchars(strip_tags($this->start_date));
    $this->end_date = htmlspecialchars(strip_tags($this->end_date));
    $this->percent_sale = htmlspecialchars(strip_tags($this->percent_sale));
    $this->status = htmlspecialchars(strip_tags($this->status));

    //bind data
    $stmt->bindParam(1, $this->name);
    $stmt->bindParam(2, $this->create_date);
    $stmt->bindParam(3, $this->start_date);
    $stmt->bindParam(4, $this->end_date);
    $stmt->bindParam(5, $this->percent_sale);
    $stmt->bindParam(6, $this->status);
    $stmt->bindParam(7, $this->id);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }

  //delete data
  public function delete()
  {
    $query = "DELETE FROM sale where id=?";
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
