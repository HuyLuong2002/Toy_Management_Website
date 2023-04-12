<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\helpers\\format.php";
?>

<?php class Orders
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    //list orders for home page
    public function show_orders_user()
    {
        $query = "SELECT * FROM orders WHERE is_deleted = '0'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_orders_by_id($id)
    {
        $query = "SELECT * FROM orders WHERE id = '{$id}'";
        $result = $this->db->select($query);
        return $result;
    }

    //live search for admin
    public function show_orders_live_search($input)
    {
        $query = "SELECT * FROM orders WHERE (orders.name LIKE '$input%')";
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_orders($id, $user_id, $total_quantity, $order_date, $total_price, $payment_method, $status, $is_deleted)
    {
        $query = "INSERT INTO orders(id, user_id, quantity, date, total_price, pay_method, status, is_deleted) VALUES ($id, $user_id, $total_quantity, $order_date, $total_price, $payment_method, $status, $is_deleted)";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = "<span class='success'>Insert orders Sucessfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Insert orders Not Sucessfully</span>";
            return $alert;
        }
    }
    public function update_orders($data, $files, $id)
    {
        $ordersName = mysqli_real_escape_string($this->db->link, $data["name"]);

        if (
            $ordersName == ""
        ) {
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        } else {
            $query = "UPDATE orders SET name='{$ordersName}' where id='{$id}'";

            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Update orders Sucessfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update orders Not Sucessfully</span>";
                return $alert;
            }
        }
    }

    public function delete_orders($id)
    {
        $query = "UPDATE orders SET is_deleted='1' WHERE id='$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>orders Deleted Sucessfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>orders Delete Not Sucessfully</span>";
            return $alert;
        }
    }
}
?>