<?php

class Provider
{
  private $conn;

  //category properties
  public $id;
  public $name;

  //connect db
  public function __construct($db)
  {
    $this->conn = $db;
  }

  //read data
  public function read()
  {
    $query = "SELECT * FROM provider";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  //show = get category by id
  public function show()
  {
    $query = "SELECT * FROM provider where id=? LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->name = $row["name"];

  }

  //create data
  public function create()
  {
    $query = "INSERT INTO provider SET name=?";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
    //bind data
    $stmt->bindParam(1, $this->name);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }

  //update data
  public function update()
  {
    $query = "UPDATE provider SET name=? where id=?";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->name = htmlspecialchars(strip_tags($this->name));

    //bind data
    $stmt->bindParam(1, $this->name);
    $stmt->bindParam(2, $this->id);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }

  //delete data
  public function delete()
  {
    $query = "DELETE FROM provider where id=?";
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
