<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/providersServices.php";

class ProviderEditController
{
    public function update_provider($data, $files, $id)
    {
        $providerService = new ProviderServices();
        $result = $providerService->update_provider($data, $files, $id);
        return $result;
    }

    public function get_provider_by_id($id)
    {
        $providerService = new ProviderServices();
        $result = $providerService->get_provider_by_id($id);
        return $result;
    }
} 
?>