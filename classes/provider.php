<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\helpers\\format.php";
?>

<?php class Provider
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    //list provider for home page
    public function show_provider_user()
    {
        $query = "SELECT * FROM provider";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_provider_by_id($id)
    {
        $query = "SELECT * FROM provider WHERE id = '{$id}'";
        $result = $this->db->select($query);
        return $result;
    }

    //live search for admin
    public function show_provider_live_search($input)
    {
        $query = "SELECT * FROM provider WHERE (provider.name LIKE '$input%')";
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_provider($data, $files)
    {
        $providerName = mysqli_real_escape_string($this->db->link, $data["name"]);
        
        if (
            $providerName == ""
        ) {
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        } else {
            $query = "INSERT INTO provider(name) VALUES ('$providerName')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Insert provider Sucessfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert provider Not Sucessfully</span>";
                return $alert;
            }
        }
    }
    public function update_provider($data, $files, $id)
    {
        $providerName = mysqli_real_escape_string($this->db->link, $data["name"]);

        if (
            $providerName == ""
        ) {
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        } else {
            $query = "UPDATE provider SET name='{$providerName}' where id='{$id}'";

            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Update provider Sucessfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update provider Not Sucessfully</span>";
                return $alert;
            }
        }
    }

    public function delete_provider($id)
    {
        $query = "DELETE FROM provider WHERE id='$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Provider Deleted Sucessfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Provider Delete Not Sucessfully</span>";
            return $alert;
        }
    }
}
?>