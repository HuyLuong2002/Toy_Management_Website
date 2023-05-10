<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/accountServices.php";
class CheckLoginController
{
    public function check_account($username)
    {
        $accountService = new AccountServices();
        $result = $accountService->check_account($username);
        return $result;
    }

    public function check_account_user($username)
    {
        $accountService = new AccountServices();
        $result = $accountService->check_account_user($username);
        return $result;
    }
}
?>