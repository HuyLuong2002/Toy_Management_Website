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
  public function show($user_id)
  {
    $query = "SELECT * FROM comment where user_id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->user_id);
    $stmt->execute();
    $rowcount = $stmt->rowCount();
    if($rowcount == 0) return false;

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->id = $row["id"];
    $this->content = $row["content"];
    $this->user_id = $row["user_id"];
    $this->product_id = $row["product_id"];
    $this->reply_id = $row["reply_id"];
    $this->rate = $row["rate"];
    $this->time = $row["time"];
    return true;
  }
}
?>
