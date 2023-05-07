<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/providersServices.php";
class ProviderController
{

  public function insert_provider($data)
  {
    $providerService = new ProviderServices();
    $result = $providerService->insert_provider($data);
    return $result;
  }
  //list provider for home page
  public function show_provider_user()
  {
    $providerService = new ProviderServices();
    $result = $providerService->show_provider_user();
    return $result;
  }

  public function update_provider($data, $id)
  {
    $providerService = new ProviderServices();
    $result = $providerService->update_provider($data, $id);
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

  public function show_provider_for_pagination()
  {
    $providerService = new ProviderServices();
    $result = $providerService->show_provider_for_pagination();
    return $result;
  }

  public function show_provider_by_panigation_admin(
    $offset,
    $limit_per_page
  ) {
    $providerService = new ProviderServices();
    $result = $providerService->show_provider_by_panigation_admin($offset, $limit_per_page);
    return $result;
  }
}
