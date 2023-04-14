<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/providersServices.php";

class ProviderAddController {
    public function insert_provider($data, $files)
    {
        $providerService = new ProviderServices();
        $result = $providerService->insert_provider($data, $files);
        return $result;
    }
}
?>