<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\helpers\\format.php";
?>

<?php class Permission
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function show_permission()
  {
    $query = "SELECT * FROM permission";
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
    $result = $this->db->insert($query);
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
    $query = "DELETE FROM permission WHERE id = {$id} AND name !='Admin'";
    $result = $this->db->insert($query);
    if ($result) {
        $alert = "<span class='success'>Delete Permission Sucessfully</span>";
        return $alert;
    } else {        
        $alert = "<span class='error'>Delete Permission Not Sucessfully</span>";
        return $alert;
    }
  }
}
?>
