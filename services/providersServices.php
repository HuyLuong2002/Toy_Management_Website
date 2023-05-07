<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\helpers\\format.php";
?>

<?php class ProviderServices
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //list provider for home page
    public function show_provider_user()
    {
        $query = "SELECT * FROM provider WHERE is_deleted=0";
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

    public function insert_provider($data)
    {
        $providerName = mysqli_real_escape_string($this->db->link, $data["name_add"]);
        
        if (
            $providerName == ""
        ) {
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        } else {
            $query = "INSERT INTO provider(name) VALUES ('$providerName')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Insert Provider Sucessfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Provider Not Sucessfully</span>";
                return $alert;
            }
        }
    }
    public function update_provider($data,$id)
    {
        $providerName = mysqli_real_escape_string($this->db->link, $data["name_edit"]);

        if (
            $providerName == ""
        ) {
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        } else {
            $query = "UPDATE provider SET name='{$providerName}' where id='{$id}'";

            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Update Provider Sucessfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update Provider Not Sucessfully</span>";
                return $alert;
            }
        }
    }

    public function delete_provider($id)
    {
        $query = "UPDATE provider SET is_deleted='1' WHERE id='$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Provider Deleted Sucessfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Provider Delete Not Sucessfully</span>";
            return $alert;
        }
    }

    public function show_provider_for_pagination() {
        $query = "SELECT * FROM provider WHERE provider.is_deleted = '0' ORDER BY provider.id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_provider_by_panigation_admin(
        $offset,
        $limit_per_page
      ) {
        $query = "SELECT * FROM provider WHERE provider.is_deleted = '0'
        ORDER BY provider.id DESC LIMIT $offset,$limit_per_page";
        $result = $this->db->select($query);
        return $result;
      }
}
?>