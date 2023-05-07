<?php

class Comment
{
  private $conn;

  //category properties
  public $id;
  public $content;
  public $user_id;
  public $product_id;
  public $reply_id;
  public $rate;
  public $time;

  //connect db
  public function __construct($db)
  {
    $this->conn = $db;
  }

  //read data
  public function read()
  {
    $query = "SELECT * FROM comment";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  //show = get category by id
  public function show($product_id)
  {
    $query = "SELECT * FROM comment where product_id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->product_id);
    $stmt->execute();
    $rowcount = $stmt->rowCount();
    if($rowcount == 0) return false;

    return $stmt;
  }
}
?>
