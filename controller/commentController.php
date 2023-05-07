<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/services/commentService.php";
class CommentController
{
    public function show_all_comment_of_product($id)
    {
        $commentService = new CommentService();
        $result = $commentService->get_all_comment_of_product($id);
        return $result;
    }

    public function add_new_comment($data)
    {
        $commentService = new CommentService();
        $result = $commentService->insert_comment_into_product($data);
        return $result;
    }
}
?>
