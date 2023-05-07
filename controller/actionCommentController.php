<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/commentController.php";
$commentController = new CommentController();
if (isset($_POST["input"]) && isset($_POST["searchkey"])) {
    $input = $_POST["input"];
    $searchkey = $_POST["searchkey"];
    
    
}
