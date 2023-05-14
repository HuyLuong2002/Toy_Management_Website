<?php

class Account
{
  private $conn;

  //category properties
  public $id;
  public $username;
  public $password;
  public $firstname;
  public $lastname;
  public $gender;
  public $date_birth;
  public $place_of_birth;
  public $create_date;
  public $permission_id;
  public $status;

  //connect db
  public function __construct($db)
  {
    $this->conn = $db;
  }

  //read data
  public function read()
  {
    $query = "SELECT * FROM account";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  //show = get category by id
  public function show()
  {
    $query = "SELECT * FROM account where id=? LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->username = $row["username"];
    $this->password = $row["password"];
    $this->firstname = $row["firstname"];
    $this->lastname = $row["lastname"];
    $this->gender = $row["gender"];
    $this->date_birth = $row["date_birth"];
    $this->place_of_birth = $row["place_of_birth"];
    $this->create_date = $row["create_date"];
    $this->permission_id = $row["permission_id"];
    $this->status = $row["status"];
  }

  //create data
  public function create()
  {
    $query =
      "INSERT INTO account(username, password, firstname, lastname, gender, date_birth, place_of_birth, create_date, permission_id, status) VALUES(?,?,?,?,?,?,?,?,?,?)";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->username = htmlspecialchars(strip_tags($this->username));
    $this->password = htmlspecialchars(strip_tags($this->password));
    $this->firstname = htmlspecialchars(strip_tags($this->firstname));
    $this->lastname = htmlspecialchars(strip_tags($this->lastname));
    $this->gender = htmlspecialchars(strip_tags($this->gender));
    $this->date_birth = htmlspecialchars(strip_tags($this->date_birth));
    $this->place_of_birth = htmlspecialchars(strip_tags($this->place_of_birth));
    $this->create_date = htmlspecialchars(strip_tags($this->create_date));
    $this->permission_id = htmlspecialchars(strip_tags($this->permission_id));
    $this->status = htmlspecialchars(strip_tags($this->status));
    
    //bind data
    $stmt->bindParam(1, $this->username);
    $stmt->bindParam(2, $this->password);
    $stmt->bindParam(3, $this->firstname);
    $stmt->bindParam(4, $this->lastname);
    $stmt->bindParam(5, $this->gender);
    $stmt->bindParam(6, $this->date_birth);
    $stmt->bindParam(7, $this->place_of_birth);
    $stmt->bindParam(8, $this->create_date);
    $stmt->bindParam(9, $this->permission_id);
    $stmt->bindParam(10, $this->status);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }

  //update data
  public function update($id)
  {
    $query = "UPDATE account SET username=?, password=?, firstname=?, lastname=?, gender=?, date_birth=?, place_of_birth=?, create_date=?, permission_id=?, status=? where id=?";
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->username = htmlspecialchars(strip_tags($this->username));
    $this->password = htmlspecialchars(strip_tags($this->password));
    $this->firstname = htmlspecialchars(strip_tags($this->firstname));
    $this->lastname = htmlspecialchars(strip_tags($this->lastname));
    $this->gender = htmlspecialchars(strip_tags($this->gender));
    $this->date_birth = htmlspecialchars(strip_tags($this->date_birth));
    $this->place_of_birth = htmlspecialchars(strip_tags($this->place_of_birth));
    $this->create_date = htmlspecialchars(strip_tags($this->create_date));
    $this->permission_id = htmlspecialchars(strip_tags($this->permission_id));
    $this->status = htmlspecialchars(strip_tags($this->status));

    //bind data
    $stmt->bindParam(1, $this->username);
    $stmt->bindParam(2, $this->password);
    $stmt->bindParam(3, $this->firstname);
    $stmt->bindParam(4, $this->lastname);
    $stmt->bindParam(5, $this->gender);
    $stmt->bindParam(6, $this->date_birth);
    $stmt->bindParam(7, $this->place_of_birth);
    $stmt->bindParam(8, $this->create_date);
    $stmt->bindParam(9, $this->permission_id);
    $stmt->bindParam(10, $this->status);
    $stmt->bindParam(11, $this->id);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error %s.\n", $stmt->error);
    return false;
  }

  //delete data
  public function delete($id)
  {
    $query = "DELETE FROM account where id=?";
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
