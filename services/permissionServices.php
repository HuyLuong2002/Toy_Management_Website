<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
?>

<?php class PermissionServices
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function show_permission()
  {
    $query = "SELECT * FROM permission WHERE is_deleted = 0";
    $result = $this->db->select($query);
    return $result;
  }

  public function get_permission_by_id($id)
  {
    $query = "SELECT * FROM permission WHERE id = {$id} LIMIT 1";
    $result = $this->db->select($query);
    return $result;
  }

  public function insert_permission($data)
  {
    $name = mysqli_real_escape_string($this->db->link, $data["name"]);
    $query = "INSERT INTO permission(name) VALUES ('$name')";
    $result = $this->db->insert($query);
    if ($result) {
      $alert = "<span class='success'>Insert Permission Sucessfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Insert Permission Not Sucessfully</span>";
      return $alert;
    }
  }

  public function update_permission($data, $id)
  {
    $name = mysqli_real_escape_string($this->db->link, $data["name"]);
    $query = "UPDATE permission SET name = '$name' WHERE id = '$id'";
    $result = $this->db->update($query);
    if ($result) {
      $alert = "<span class='success'>Update Permission Sucessfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Update Permission Not Sucessfully</span>";
      return $alert;
    }
  }

  public function delete_permission($id)
  {
    $query = "UPDATE permission SET is_deleted='1' WHERE id='$id' AND name!='Admin'";
    $result = $this->db->delete($query);
    if ($result) {
      $alert = "<span class='success'>Delete Permission Sucessfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Delete Permission Not Sucessfully</span>";
      return $alert;
    }
  }

  //live search for admin
  public function show_permission_live_search($input)
  {
    $query = "SELECT * FROM permission WHERE (permission.name LIKE '$input%')";
    $result = $this->db->select($query);
    return $result;
  }
}
?>
