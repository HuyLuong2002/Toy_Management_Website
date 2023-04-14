<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/providersServices.php";
class ProviderController
{
  //list provider for home page
  public function show_provider_user()
  {
    $providerService = new ProviderServices();
    $result = $providerService->show_provider_user();
    return $result;
  }

  public function get_provider_by_id($id)
  {
    $providerService = new ProviderServices();
    $result = $providerService->get_provider_by_id($id);
    return $result;
  }

  //live search for admin
  public function show_provider_live_search($input)
  {
    $providerService = new ProviderServices();
    $result = $providerService->show_provider_live_search($input);
    return $result;
  }

  public function delete_provider($id)
  {
    $providerService = new ProviderServices();
    $result = $providerService->delete_provider($id);
    return $result;
  }
}

?>
