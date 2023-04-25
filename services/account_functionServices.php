<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\lib\session.php";
?>
<?php class AccountFunctionServices
{
  private $db;
  public function __construct()
  {
    $this->db = new Database();
  }
  public function show_account_function()
  {
    $query = "SELECT * FROM account_function WHERE is_deleted = 0";
    $result = $this->db->select($query);
    return $result;
  }
  public function show_account_function_by_id($id)
  {
    $query = "SELECT * FROM account_function WHERE is_deleted = 0 AND id='{$id}'";
    $result = $this->db->select($query);
    return $result;
  }
  public function insert_account_function($data)
  {
    $name = mysqli_real_escape_string($this->db->link, $data["name"]);
    if ($name == "") {
      $alert = "<span class='error'>Fields must be not empty</span>";
      return $alert;
    } else {
      $query = "INSERT INTO account_function(name) VALUES ('$name')";
      $result = $this->db->insert($query);
      if ($result) {
        $alert =
          "<span class='success'>Insert Account Function Sucessfully</span>";
        return $alert;
      } else {
        $alert =
          "<span class='error'>Insert Account Function Not Sucessfully</span>";
        return $alert;
      }
    }
  }
  public function update_account_function($data, $id)
  {
    $name = mysqli_real_escape_string($this->db->link, $data["name"]);
    if ($name == "") {
      $alert = "<span class='error'>Fields must be not empty</span>";
      return $alert;
    } else {
      $query = "UPDATE account_function SET name = '{$name}' WHERE id='{$id}'";
      $result = $this->db->update($query);
      if ($result) {
        $alert =
          "<span class='success'>Update Account Function Sucessfully</span>";
        return $alert;
      } else {
        $alert =
          "<span class='error'>Update Account Function Not Sucessfully</span>";
        return $alert;
      }
    }
  }
  public function delete_account_function($id)
  {
    $query = "UPDATE account_function SET is_deleted='1' WHERE id='{$id}'";
    $result = $this->db->delete($query);
    if ($result) {
      $alert =
        "<span class='success'>Delete Account Function Sucessfully</span>";
      return $alert;
    } else {
      $alert =
        "<span class='error'>Delete Account Function Not Sucessfully</span>";
      return $alert;
    }
  }
} ?>
