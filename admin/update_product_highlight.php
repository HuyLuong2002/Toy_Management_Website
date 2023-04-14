<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/productsController.php";

$productsController = new ProductsController();
if(isset($_POST['state']) && isset($_POST['id']))
{
    // Lấy giá trị highlight được gửi từ Ajax
    $highlight = $_POST['state'];
    $id = $_POST['id'];

    $result_update_highlight = $productsController->update_product_highlight($highlight, $id);
    
}


?>