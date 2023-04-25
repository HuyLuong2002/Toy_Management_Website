<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/account_functionServices.php";
include_once $filepath . "/helpers/format.php";
class AccountFunctionController
{
  private $fm;
  public function __construct()
  {
    $this->fm = new Format();
  }

  public function show_account_function()
  {
    $account_functionService = new AccountFunctionServices();
    $result = $account_functionService->show_account_function();
    return $result;
  }

  public function show_account_function_by_id($id)
  {
    $account_functionService = new AccountFunctionServices();
    $result = $account_functionService->show_account_function_by_id($id);
    return $result;
  }

  public function insert_account_function($data)
  {
    $account_functionService = new AccountFunctionServices();
    $result = $account_functionService->insert_account_function($data);
    return $result;
  }

  public function update_account_function($data, $id)
  {
      $account_functionService = new AccountFunctionServices();
      $result = $account_functionService->update_account_function($data, $id);
      return $result;
  }

  public function delete_account_function($id)
  {
      $account_functionService = new AccountFunctionServices();
      $result = $account_functionService->delete_account_function($id);
      return $result;
  }
}
?>
