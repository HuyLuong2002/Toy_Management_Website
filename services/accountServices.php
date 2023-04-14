<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\lib\session.php";
?>

<?php class AccountServices
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function show_account()
  {
    $query = "SELECT * FROM account";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_account_by_id($id)
  {
    $query = "SELECT * FROM account WHERE id='{$id}'";
    $result = $this->db->select($query);
    return $result;
  }

  public function login($username, $password)
  {
    $query = "SELECT * FROM account WHERE username='{$username}' and password='{$password}'";
    $result = $this->db->select($query);
    return $result;
  }

  public function check_account($username)
  {
    $query = "SELECT * FROM account WHERE username='{$username}' REGEXP BINARY '[a-z0-9]'";
    $result = $this->db->select($query);
    return $result;
  }

  public function insert_account($username, $password)
  {
    $username = mysqli_real_escape_string($this->db->link, $username);
    $password = mysqli_real_escape_string($this->db->link, $password);

    if (empty($username)) {
      $alert = "<span class='error'>Username must be not empty</span>";
      return $alert;
    } else {
      $query = "INSERT INTO account(username, password, permission_id, status) VALUES ('$username','$password','4','1')";
      $result = $this->db->insert($query);
      if ($result) {
        $alert = "<span class='success'>Insert Username Sucessfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Insert Username Not Sucessfully</span>";
        return $alert;
      }
    }
  }
}
?>
