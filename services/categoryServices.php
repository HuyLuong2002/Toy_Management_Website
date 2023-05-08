<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
?>

<?php class CategoryServices
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function show_category()
    {
        $query = "SELECT * FROM category where is_deleted = '0' ORDER BY id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_category_by_id($category_id)
    {
        $query = "SELECT * FROM category WHERE id = '$category_id' and is_deleted = '0'";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_category_live_search($input)
    {
        $query = "SELECT * FROM category WHERE (category.name LIKE '$input%') AND is_deleted = '0'";
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_category($data)
    {
        $categoryName = mysqli_real_escape_string($this->db->link, $data["name_add"]);

        if (
            $categoryName == ""
        ) {
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        } else {
            $query = "INSERT INTO category(name) VALUES ('$categoryName')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Insert category Sucessfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert category Not Sucessfully</span>";
                return $alert;
            }
        }
    }
    public function update_category($data, $id)
    {
        $categoryName = mysqli_real_escape_string($this->db->link, $data["name_edit"]);

        if (
            $categoryName == ""
        ) {
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        } else {
            $query = "UPDATE category SET name='{$categoryName}' where id='{$id}'";

            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Update category Sucessfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update category Not Sucessfully</span>";
                return $alert;
            }
        }
    }

    public function delete_category($id)
    {
        $query = "UPDATE category SET is_deleted='1' WHERE id='$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>category Deleted Sucessfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>category Delete Not Sucessfully</span>";
            return $alert;
        }
    }
}
?>