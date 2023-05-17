<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath .
  "\Toy_Management_Website\controller\check_loginController.php";
include_once $filepath . "\controller\permissionController.php";

$check_loginController = new CheckLoginController();
$permissionController = new PermissionController();
if (isset($_POST["nome"])) {
  $result_check_login = $check_loginController->check_account_user(
    $_POST["nome"]
  );

  if ($result_check_login == false) {
    $count = 0;
  } else {
    $count = $result_check_login->num_rows;
  }

  if ($count != 0) {
    // echo "<span style='color:red'>Username already used.</span>";
    // echo "<script>document.getElementById('btn-sign-up').disabled = false;</script>";
    echo false;
  } else {
    // echo "<span style='color:green'>Username available for Registration.</span>";
    // echo "<script>document.getElementById('btn-sign-up').disabled = false;</script>";
    echo true;
  }
}

if (isset($_POST["permission"])) {
  $result_permission = $permissionController->check_permission(
    $_POST["permission"]
  );

  if ($result_permission == false) {
    $count = 0;
  } else {
    $count = $result_permission->num_rows;
  }

  if ($count != 0) {
    echo false;
  } else {
    echo true;
  }
}
