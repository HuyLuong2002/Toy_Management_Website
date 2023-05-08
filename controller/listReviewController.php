<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/commentController.php";
$commentController = new CommentController();
if (isset($_POST["review"])) {

    $newReview = $_POST["review"];
    $result = $commentController->add_new_comment($newReview);
    
    return $result;
}

?>
