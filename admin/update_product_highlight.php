<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/classes/product.php";

$product = new Product();
if(isset($_POST['state']) && isset($_POST['id']))
{
    // Lấy giá trị highlight được gửi từ Ajax
    $highlight = $_POST['state'];
    $id = $_POST['id'];
    $result_update_highlight = $product->update_product_highlight($highlight, $id);
    
}


?>