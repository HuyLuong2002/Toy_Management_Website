<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
?>

<?php class CommentService
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function get_all_comment_of_product($id)
    {
        $query = "SELECT * FROM comment WHERE id = '{$id}' ORDER BY time desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_comment_into_product($data)
    {
        $content = mysqli_real_escape_string($this->db->link, $data["content"]);
        $user_id = mysqli_real_escape_string($this->db->link, $data["user_id"]);
        $product_id = mysqli_real_escape_string($this->db->link, $data["product_id"]);
        $rate = mysqli_real_escape_string($this->db->link, $data["price"]);
        $create_date = (string) date("d/m/Y");
        
        if (
            $content == "" ||
            $user_id == "" ||
            $product_id == "" ||
            $rate == "" ||
            $create_date == "" 
        ) {
            $alert = "<span class='error'>Something went wrong</span>";
            return $alert;
        } else {
            $query = "INSERT INTO comment(content, user_id, product_id, rate, create_date) 
            VALUES ($content, $user_id, '$product_id', $rate, '$create_date')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Add Comment Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Add Comment Failed</span>";
                return $alert;
            }
        }
    }
}

?>
