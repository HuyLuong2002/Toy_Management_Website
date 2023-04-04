<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\helpers\\format.php";
?>

<?php class Account
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }


  public function show_account()
  {
    $query = "SELECT * FROM account";
    $result = $this->db->select($query);
    return $result;
  }

  public function check_account($username)
  {
    $query = "SELECT * FROM account WHERE username='{$username}'";
    $result = $this->db->select($query);
    return $result;
  }

  public function insert_account($username, $password)
  {
    $username = $this->fm->validation($username);
    $username = mysqli_real_escape_string($this->db->link, $username);

    $password = $this->fm->validation($password);
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
