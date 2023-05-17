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
        } elseif ($result["permission_id"] == 3) {
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

          header("Location: ./admin/index.php?id=5");
        } elseif ($result["permission_id"] == 4) {
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

          header("Location: ./admin/index.php?id=2");
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

  public function insert_account_user($data)
  {
    $data["nome"] = $this->fm->validation($data["nome"]);
    $data["password"] = $this->fm->validation($data["password"]);
    $data["date_birth"] = $this->fm->formatDate($data["date_birth"]);
    $data["firstname"] = $this->fm->validation($data["firstname"]);
    $data["lastname"] = $this->fm->validation($data["lastname"]);
    if ($data["gender"] == "Nam") {
      $data["gender"] = "Nam";
    } else {
      $data["gender"] = "Nữ";
    }

    $accountService = new AccountServices();
    $result = $accountService->insert_account_user($data);
    return $result;
  }

  public function insert_account_admin($data)
  {
    $accountService = new AccountServices();
    $check_account = $accountService->check_account($data["username_add"]);
    if ($check_account == false) {
      $data["username_add"] = $this->fm->validation($data["username_add"]);
      $data["password_add"] = $this->fm->validation($data["password_add"]);
      $data["password_add"] = md5($data["password_add"]);
      $data["dateofbirth_add"] = $this->fm->formatDate(
        $data["dateofbirth_add"]
      );
      if ($data["gender_add"] == "Nam") {
        $data["gender_add"] = "Nam";
      } else {
        $data["gender_add"] = "Nữ";
      }

      $result = $accountService->insert_account_admin($data);
      return $result;
    }
    $result = "<span class='error'>Username existed</span>";
    return $result;
  }

  public function update_account($data, $id)
  {
    $accountService = new AccountServices();

    $data["status_edit"] = intval($data["status_edit"]);
    $get_account = $accountService->show_account_by_id($id);
    $result = $get_account->fetch_array();
    if ($result[9] == "1") {
      $alert = "<span class='error'>Can Not Update Admin</span>";
      return $alert;
    }
    if ($result[9] == "3") {
      $alert = "<span class='error'>Can Not Update Manager</span>";
      return $alert;
    }
    $result = $accountService->update_account($data, $id);
    return $result;
  }

  public function update_account_user($data, $id)
  {
    $data["date_birth"] = $this->fm->formatDate($data["date_birth"]);
    if ($data["gender"] == "Nam") {
      $data["gender"] = "Nam";
    } else {
      $data["gender"] = "Nữ";
    }
    $data["password"] = $this->fm->validation($data["password"]);
    $accountService = new AccountServices();
    $result = $accountService->update_account_user($data, $id);
    return $result;
  }

  public function delete_account($id)
  {
    $accountService = new AccountServices();
    $get_account = $accountService->show_account_by_id($id);
    $result = $get_account->fetch_array();
    if ($result[9] == "1") {
      $alert = "<span class='error'>Can Not Delete Admin</span>";
      return $alert;
    }
    if ($result[9] == "3") {
      $alert = "<span class='error'>Can Not Delete Manager</span>";
      return $alert;
    }
    $result_delete = $accountService->delete_account($id);
    $alert = $result_delete;
    return $alert;
    // $result = $accountService->delete_account($id);
    // return $result;
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

  public function show_account_by_pagination($offset, $limit_per_page)
  {
    $accountService = new AccountServices();
    $result = $accountService->show_account_by_pagination(
      $offset,
      $limit_per_page
    );
    return $result;
  }

  public function show_accounts_live_search($input)
  {
    $accountService = new AccountServices();
    $result = $accountService->show_accounts_live_search($input);
    return $result;
  }
}
