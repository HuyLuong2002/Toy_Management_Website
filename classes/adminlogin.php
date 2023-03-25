<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\lib\session.php";
Session::checkLogin();
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\helpers\\format.php";
?>

<?php class AdminLogin
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function login_admin($adminUser, $adminPass)
  {
    $adminUser = $this->fm->validation($adminUser);
    $adminPass = $this->fm->validation($adminPass);

    $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
    $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

    if (empty($adminUser) || empty($adminPass)) {
      $alert = "User and Pass must be not empty";
      return $alert;
    } else {
      $query = "SELECT * FROM account where username='$adminUser' and password='$adminPass' LIMIT 1";
      $result = $this->db->select($query);

      if ($result != false) {
        /*fetch_assoc()
                được sử dụng để lấy dữ liệu từ kết quả truy vấn dưới dạng một mảng kết hợp 
                (associative array), trong đó các khóa (keys) được thiết lập theo tên các cột 
                và các giá trị (values) là các giá trị tương ứng của các cột 
                trong kết quả truy vấn
                */

        /*fetch_array()
                được sử dụng để lấy dữ liệu từ kết quả truy vấn dưới dạng 
                một mảng số học (numeric array), trong đó các giá trị được thiết lập theo 
                thứ tự của các cột trong kết quả truy vấn
                */

        $value = $result->fetch_assoc();
        Session::set("adminlogin", true);
        Session::set("adminId", $value["id"]);
        Session::set("adminUser", $value["username"]);
        Session::set(
          "adminName",
          $value["firstname"] . " " . $value["lastname"]
        );
        header("Location:index.php");
      } else {
        $alert = "User and Pass not match";
        return $alert;
      }
    }
  }
}

?>
