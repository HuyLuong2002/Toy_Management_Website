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

  public function get_permission_id()
  {
    $query = "SELECT * FROM permission ORDER BY id desc LIMIT 1";
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
}
?>
