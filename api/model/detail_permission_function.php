<?php

class DetailPermissionFunction
{
  private $conn;

  //category properties
  public $id;
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
  public function show_detail_permission()
  {
    $query = "SELECT * FROM detail_permission_function where permission_id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->permission_id);
    $stmt->execute();

    return $stmt;
  }

  //show = get detail function by function_id
  public function show_detail_function()
  {
    $query = "SELECT * FROM detail_permission_function where function_id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->function_id);
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
