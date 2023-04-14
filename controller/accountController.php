<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/accountServices.php";
include_once $filepath . "/helpers/format.php";
class AccountController
{
  private $fm;
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
          $timeout = 120;
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
        return "User account is disabled";
      }
    } else {
      return "User and Pass not match";
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

  public function show_account_by_id($id)
  {
    $accountService = new AccountServices();
    $result = $accountService->show_account_by_id($id);
    return $result;
  }
}
?>
