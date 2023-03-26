<?php

class Product
{
  private $conn;

  //category properties
  public $id;
  public $name;
  public $image;
  public $price;
  public $create_date;
  public $highlight;
  public $category_id;
  public $sale_id;
  public $review;
  public $quantity;

  //connect db
  public function __construct($db)
  {
    $this->conn = $db;
  }

  //read data
  public function read()
  {
    $query = "SELECT * FROM product";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  //show = get category by id
  public function show($id)
  {
    $query = "SELECT * FROM product where id=? LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->name = $row["name"];
    $this->image = $row["image"];
    $this->price = $row["price"];
    $this->create_date = $row["create_date"];
    $this->highlight = $row["highlight"];
    $this->category_id = $row["category_id"];
    $this->sale_id = $row["sale_id"];
    $this->review = $row["review"];
    $this->quantity = $row["quantity"];
  }

  //create data
  public function create()
  {
    $query = "INSERT INTO product(name, image, price, create_date, highlight, category_id, sale_id, review, quantity) VALUES(?,?,?,?,?,?,?,?,?)";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->image = htmlspecialchars(strip_tags($this->image));
    $this->price = htmlspecialchars(strip_tags($this->price));
    $this->create_date = htmlspecialchars(strip_tags($this->create_date));
    $this->highlight = htmlspecialchars(strip_tags($this->highlight));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    $this->sale_id = htmlspecialchars(strip_tags($this->sale_id));
    $this->review = htmlspecialchars(strip_tags($this->review));
    $this->quantity = htmlspecialchars(strip_tags($this->quantity));
    //bind data
    $stmt->bindParam(1, $this->name);
    $stmt->bindParam(2, $this->image);
    $stmt->bindParam(3, $this->price);
    $stmt->bindParam(4, $this->create_date);
    $stmt->bindParam(5, $this->highlight);
    $stmt->bindParam(6, $this->category_id);
    $stmt->bindParam(7, $this->sale_id);
    $stmt->bindParam(8, $this->review);
    $stmt->bindParam(9, $this->quantity);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }

  //update data
  public function update($id)
  {
    $query = "UPDATE product SET name=?, image=?, price=?, create_date=?, highlight=?, category_id=?, sale_id=?, review=?, quantity=? where id=?";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->image = htmlspecialchars(strip_tags($this->image));
    $this->price = htmlspecialchars(strip_tags($this->price));
    $this->create_date = htmlspecialchars(strip_tags($this->create_date));
    $this->highlight = htmlspecialchars(strip_tags($this->highlight));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    $this->sale_id = htmlspecialchars(strip_tags($this->sale_id));
    $this->review = htmlspecialchars(strip_tags($this->review));
    $this->quantity = htmlspecialchars(strip_tags($this->quantity));

    //bind data
    $stmt->bindParam(1, $this->name);
    $stmt->bindParam(2, $this->image);
    $stmt->bindParam(3, $this->price);
    $stmt->bindParam(4, $this->create_date);
    $stmt->bindParam(5, $this->highlight);
    $stmt->bindParam(6, $this->category_id);
    $stmt->bindParam(7, $this->sale_id);
    $stmt->bindParam(8, $this->review);
    $stmt->bindParam(9, $this->quantity);
    $stmt->bindParam(10, $this->id);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }

  //delete data
  public function delete($id)
  {
    $query = "DELETE FROM product where id=?";
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
