<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/accountServices.php";
include_once $filepath . "/helpers/format.php";
class AccountController
{
  private $fm;
  public function __construct()
  {
    $this->fm = new Format();
  }
  public function login($username, $password)
  {
    $accountService = new AccountServices();
    $result = $accountService->login($username, md5($password));
    if (isset($result) && isset($result->num_rows)) {
      $count_login = $result->num_rows;
    } else {
      $count_login = 0;
    }
    if ($count_login > 0) {
      $result = $result->fetch_assoc();
      if ($result["status"] == 1) {
        if ($result["permission_id"] == 1) {
          Session::init();
          Session::set("userAdmin", true);
          Session::set("user", true);
          Session::set("userID", $result["id"]);
          Session::set("username", $result["username"]);
          Session::set(
            "fullname",
            $result["firstname"] . " " . $result["lastname"]
          );

          //Set the session timeout for 2 seconds
          $timeout = 900;
          Session::set("timeout", $timeout);
          //Set the maxlifetime of the session
          ini_set("session.gc_maxlifetime", $timeout);
          //Set the cookie lifetime of the session
          ini_set("session.cookie_lifetime", $timeout);

          header("Location: ./admin/index.php?id=1");
        } else {
          Session::init();
          Session::set("user", true);
          Session::set("userAdmin", false);
          Session::set("userID", $result["id"]);
          Session::set("username", $result["username"]);
          Session::set(
            "fullname",
            $result["firstname"] . " " . $result["lastname"]
          );

          //Set the session timeout for 1800 seconds
          $timeout = 1800;
          Session::set("timeout", $timeout);
          //Set the maxlifetime of the session
          ini_set("session.gc_maxlifetime", $timeout);
          //Set the cookie lifetime of the session
          ini_set("session.cookie_lifetime", $timeout);

          header("Location: ./index.php");
        }
      } else {
        return "<span class='error'>User account is disabled</span>";
      }
    } else {
      return "<span class='error'>User and Pass not match</span>";
    }
  }

  public function insert_account($username, $password)
  {
    $username = $this->fm->validation($username);
    $password = $this->fm->validation($password);
    $accountService = new AccountServices();
    $result = $accountService->insert_account($username, $password);
    return $result;
  }

  public function insert_account_admin($data)
  {
    $accountService = new AccountServices();
    $check_account = $accountService->check_account($data["username"]);
    if ($check_account) {
      $data["username"] = $this->fm->validation($data["username"]);
      $data["password"] = $this->fm->validation($data["password"]);
      $data["password"] = md5($data["password"]);
      $data["dateofbirth"] = $this->fm->formatDate($data["dateofbirth"]);
      if ($data["gender"] == 0) {
        $data["gender"] = "Nam";
      } else {
        $data["gender"] = "Nữ";
      }

      $result = $accountService->insert_account_admin($data);
      return $result;
    }
    $result = "<span class='error'>Username existed</span>";
    return $result;
  }

  public function update_account($data, $id)
  {
    $data["dateofbirth"] = $this->fm->formatDate($data["dateofbirth"]);
    if ($data["gender"] == 0) {
      $data["gender"] = "Nam";
    } else {
      $data["gender"] = "Nữ";
    }
    $data["status"] = intval($data["status"]);
    $accountService = new AccountServices();
    $result = $accountService->update_account($data, $id);
    return $result;
  }

  public function delete_account($id) 
  {
    $accountService = new AccountServices();
    $result = $accountService->delete_account($id);
    return $result;
  }

  public function show_account_by_id($id)
  {
    $accountService = new AccountServices();
    $result = $accountService->show_account_by_id($id);
    return $result;
  }

  public function show_account()
  {
    $accountService = new AccountServices();
    $result = $accountService->show_account();
    return $result;
  }

  public function show_account_user()
  {
    $accountService = new AccountServices();
    $result = $accountService->show_account_user();
    return $result;
  }
}
?>
