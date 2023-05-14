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
    $query = "SELECT * FROM account, permission WHERE account.is_deleted = 0 AND permission_id = permission.id";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_account_by_id($id)
  {
    $query = "SELECT * FROM account WHERE id='{$id}' LIMIT 1";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_account_by_pagination($offset, $limit_per_page)
  {
    $query = "SELECT * FROM account, permission WHERE account.is_deleted = 0 AND permission_id = permission.id
    LIMIT $offset, $limit_per_page";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_accounts_live_search($input)
  {
    $query = "SELECT * FROM account, permission WHERE ((account.username LIKE '%$input%') OR (account.password LIKE '%$input%') OR (account.firstname LIKE '%$input%') 
    OR (account.lastname LIKE '%$input%') OR (account.gender LIKE '%$input%') OR (account.date_birth LIKE '%$input%') OR (account.place_of_birth LIKE '%$input%') OR (permission.name LIKE '%$input%'))
    AND account.permission_id = permission.id AND account.is_deleted = 0";
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
    $query = "SELECT * FROM account WHERE username='{$username}'";
    $result = $this->db->select($query);
    return $result;
  }

  public function check_account_user($username)
  {
    $query = "SELECT * FROM account WHERE username='{$username}' AND is_deleted = 0";
    $result = $this->db->select($query);
    return $result;
  }

  public function insert_account_user($data)
  {
    $username = mysqli_real_escape_string($this->db->link, $data["nome"]);
    $password = mysqli_real_escape_string($this->db->link, $data["password"]);
    $firstname = mysqli_real_escape_string($this->db->link, $data["firstname"]);
    $lastname = mysqli_real_escape_string($this->db->link, $data["lastname"]);
    $gender = mysqli_real_escape_string($this->db->link, $data["gender"]);
    $date_birth = mysqli_real_escape_string($this->db->link, $data["date_birth"]);
    $place_of_birth = mysqli_real_escape_string($this->db->link, $data["place_of_birth"]);
    $create_date = (string) date("d/m/Y");

    $hashPassword = md5($password);

    if (
      $username == "" ||
      $password == "" ||
      $firstname == "" ||
      $lastname == "" ||
      $gender == "" ||
      $date_birth == "" ||
      $place_of_birth == ""
    ) {
      $alert = "<span class='error'>Fields must be not empty</span>";
      return $alert;
    } else {
      $query = "INSERT INTO account(username, password, firstname, lastname, gender, date_birth, place_of_birth, create_date, permission_id, status, is_deleted) VALUES ('$username', '$hashPassword', '$firstname', '$lastname', '$gender', '$date_birth', '$place_of_birth', '$create_date', '2', '1', '0')";
      $result = $this->db->insert($query);
      if ($result) {
        $alert = "<span class='success'>Create Account Sucessfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Create Account Not Sucessfully</span>";
        return $alert;
      }
    }
  }

  public function insert_account_admin($data)
  {
    $username = mysqli_real_escape_string($this->db->link, $data["username_add"]);
    $password = mysqli_real_escape_string($this->db->link, $data["password_add"]);
    $firstname = mysqli_real_escape_string($this->db->link, $data["firstname_add"]);
    $lastname = mysqli_real_escape_string($this->db->link, $data["lastname_add"]);
    $gender = mysqli_real_escape_string($this->db->link, $data["gender_add"]);
    $date_birth = mysqli_real_escape_string($this->db->link, $data["dateofbirth_add"]);

    $place_of_birth = mysqli_real_escape_string($this->db->link, $data["placeofbirth_add"]);
    $create_date = (string) date("d/m/Y");
    $permission_id = mysqli_real_escape_string($this->db->link, $data["permission_add"]);
    $status = mysqli_real_escape_string($this->db->link, $data["status_add"]);
    if (
      $username == "" ||
      $password == "" ||
      $firstname == "" ||
      $lastname == "" ||
      $gender == "" ||
      $date_birth == "" ||
      $place_of_birth == "" ||
      $permission_id == "" ||
      $status == ""
    ) {
      $alert = "<span class='error'>Fields must be not empty</span>";
      return $alert;
    } else {
      $query = "INSERT INTO account(username, password, firstname, lastname, gender, date_birth, place_of_birth, create_date, permission_id, status, is_deleted) VALUES ('$username', '$password', '$firstname', '$lastname', '$gender', '$date_birth', '$place_of_birth', '$create_date', $permission_id, '$status', '0')";
      $result = $this->db->insert($query);
      if ($result) {
        $alert = "<span class='success'>Insert Account Sucessfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Insert Account Not Sucessfully</span>";
        return $alert;
      }
    }
  }

  public function update_account($data, $id)
  {
    $username = mysqli_real_escape_string($this->db->link, $data["username_edit"]);
    $firstname = mysqli_real_escape_string($this->db->link, $data["firstname_edit"]);
    $lastname = mysqli_real_escape_string($this->db->link, $data["lastname_edit"]);
    $gender = mysqli_real_escape_string($this->db->link, $data["gender_edit"]);
    $date_birth = mysqli_real_escape_string($this->db->link, $data["dateofbirth_edit"]);
    $place_of_birth = mysqli_real_escape_string($this->db->link, $data["placeofbirth_edit"]);
    $create_date = (string) date("d/m/Y");
    $permission_id = mysqli_real_escape_string($this->db->link, $data["permission_edit"]);
    $status = mysqli_real_escape_string($this->db->link, $data["status_edit"]);
    $password = mysqli_real_escape_string($this->db->link, $data["password_edit"]);
    if (strlen($password) <= 20) {
      $hashed_string = md5($password);
    } else {
      $hashed_string = $password;
    }
    if (
      $username == "" ||
      $password == "" ||
      $firstname == "" ||
      $lastname == "" ||
      $gender == "" ||
      $date_birth == "" ||
      $place_of_birth == "" ||
      $permission_id == "" ||
      $status == ""
    ) {
      $alert = "<span class='error'>Fields must be not empty</span>";
      return $alert;
    } else {
      $query = "UPDATE account SET username='{$username}' ,firstname='{$firstname}', lastname='{$lastname}', gender='{$gender}', date_birth='{$date_birth}', place_of_birth='{$place_of_birth}', create_date='{$create_date}', permission_id = '{$permission_id}',password='{$hashed_string}' ,account.status='{$status}' WHERE id = '{$id}'";
      $result = $this->db->update($query);
      if ($result) {
        $alert = "<span class='success'>Update Account Sucessfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Update Account Not Sucessfully</span>";
        return $alert;
      }
    }
  }

  public function update_account_user($data, $id)
  {
    $firstname = mysqli_real_escape_string($this->db->link, $data["firstname"]);
    $lastname = mysqli_real_escape_string($this->db->link, $data["lastname"]);
    $gender = mysqli_real_escape_string($this->db->link, $data["gender"]);
    $date_birth = mysqli_real_escape_string($this->db->link, $data["date_birth"]);
    $place_of_birth = mysqli_real_escape_string($this->db->link, $data["place_of_birth"]);
    $create_date = (string) date("d/m/Y");
    $password = mysqli_real_escape_string($this->db->link, $data["password"]);
    if (strlen($password) <= 20) {
      $hashed_string = md5($password);
    } else {
      $hashed_string = $password;
    }
    if (
      $firstname == "" ||
      $lastname == "" ||
      $gender == "" ||
      $date_birth == "" ||
      $place_of_birth == "" ||
      $password == ""
    ) {
      $alert = "<span class='error'>Fields must be not empty</span>";
      return $alert;
    } else {
      $query = "UPDATE account SET firstname='{$firstname}', lastname='{$lastname}', gender='{$gender}', date_birth='{$date_birth}', place_of_birth='{$place_of_birth}', create_date='{$create_date}', password='{$hashed_string}' WHERE id = '{$id}'";
      $result = $this->db->update($query);
      if ($result) {
        $alert = "<span class='success'>Update Account Sucessfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Update Account Not Sucessfully</span>";
        return $alert;
      }
    }
  }

  public function delete_account($id)
  {
    $query = "UPDATE account SET is_deleted='1' WHERE id='$id' AND account.permission_id!='1'";
    $result = $this->db->delete($query);
    if ($result) {
      $alert = "<span class='success'>Delete Account Sucessfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Delete Account Not Sucessfully</span>";
      return $alert;
    }
  }

  public function show_account_user()
  {
    $query = "SELECT * FROM account, permission WHERE permission_id = permission.id AND permission.name = 'Khách hàng'";
    $result = $this->db->select($query);
    return $result;
  }
}
?>
