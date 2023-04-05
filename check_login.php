<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\Toy_Management_Website\classes\account.php";

$account = new Account();
if (isset($_POST["nome"])) {
  $result_check_login = $account->login($_POST["nome"], $_POST["password"]);

  if(isset($result_check_login) && isset($result_check_login->num_rows))
  {
    $count = $result_check_login->num_rows;
  }
  else
  {
      $count = 0;
  }
  if ($count > 0) {
    $result = $result_check_login->fetch_assoc();
    if($result["status"] == 1)
    {
      if($result["permission"] == 1)
      {
        header("Location: ./admin/index.php");
      }
      else {
        header("Location: index.php");
      }
    }
    else {

    }
  } else {
    echo "<span style='color:green'>Username available for Registration.</span>";
    echo "<script> $('#btn-sign-in').prop('disabled', false);</script>";
  }
}


?>
