<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\Toy_Management_Website\classes\account.php";

$account = new Account();
if (isset($_POST["nome"])) {
  $result_check_login = $account->check_account($_POST["nome"]);

  if(isset($result_check_login) && isset($result_check_login->num_rows))
  {
    $count = $result_check_login->num_rows;
  }
  else
  {
      $count = 0;
  }
  if ($count > 0) {
    echo "<span style='color:red'>Username already used.</span>";
    echo "<script>document.getElementById('btn-sign-up').disabled = true;</script>";
  } else {
    echo "<span style='color:green'>Username available for Registration.</span>";
    echo "<script>document.getElementById('btn-sign-up').disabled = false;</script>";
  }
}


?>
