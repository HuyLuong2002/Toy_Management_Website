<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "/helpers/format.php";
?>

<?php class SaleServices
{
  private $db;
  private $fm;
  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function show_sale()
  {
    $query = "SELECT * FROM sale WHERE sale.is_deleted = '0'";
    $result = $this->db->select($query);
    return $result;
  }

  // live search sale for admin
  public function show_sale_live_search($input)
  {
    $query = "SELECT * FROM sale WHERE ((sale.name LIKE '%$input%') OR (sale.percent_sale LIKE '%$input%') OR (sale.start_date LIKE '%$input%') OR (sale.end_date LIKE '%$input%')) AND is_deleted = '0'";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_sale_by_pagination($offset, $limit_per_page){
    $query = "SELECT * FROM sale WHERE sale.is_deleted = '0' LIMIT $offset, $limit_per_page";
    $result = $this->db->select($query);
    return $result;
  }

  public function get_sale_by_id($id){
    $query = "SELECT * FROM sale WHERE id ='{$id}'";
    $result = $this->db->select($query);
    return $result;
  }

  public function insert_sale($data){
    $saleName = mysqli_real_escape_string($this->db->link, $data["name_add"]);
    $percent_sale = mysqli_real_escape_string($this->db->link, $data["percent_add"]);
    $status = mysqli_real_escape_string($this->db->link, $data["status_add"]);
    $start_date = mysqli_real_escape_string($this->db->link, $data["start_add"]);
    $end_date = mysqli_real_escape_string($this->db->link, $data["end_add"]);
    $start_date = $this->fm->formatDate($start_date);
    $end_date = $this->fm->formatDate($end_date);
    $create_date = (string) date("d/m/Y");
    if (
      $saleName == "" || 
      $percent_sale == "" ||
      $status == "" ||
      $start_date == "" ||
      $end_date == ""){
      $alert = "<span class='error'>Fields must be not empty</span>";
      return $alert;
    } if ($start_date > $end_date){
      $alert = "<span class='error'>Start date is not greater than End date</span>";
      return $alert;
    } else {
      $query = "INSERT INTO sale(name, create_date, start_date, end_date, percent_sale, status, is_deleted) VALUES ('$saleName', '$create_date', '$start_date', '$end_date', '$percent_sale', '$status', '0')";
      $result = $this->db->insert($query);
      if ($result){
        $alert = "<span class='success'>Insert Sale Sucessfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Insert Sale Not Sucessfully</span>";
        return $alert;
      }
    }
  }

  public function update_sale($data, $id){
    $saleName = mysqli_real_escape_string($this->db->link, $data["name_edit"]);
    $percent_sale = mysqli_real_escape_string($this->db->link, $data["percent_edit"]);
    $status = mysqli_real_escape_string($this->db->link, $data["status_edit"]);
    $start_date = mysqli_real_escape_string($this->db->link, $data["start_edit"]);
    $end_date = mysqli_real_escape_string($this->db->link, $data["end_edit"]);
    $start_date = $this->fm->formatDate($start_date);
    $end_date = $this->fm->formatDate($end_date);
    $create_date = (string) date("d/m/Y");
    if (
      $saleName == "" || 
      $percent_sale == "" ||
      $status == "" ||
      $start_date == "" ||
      $end_date == ""){
      $alert = "<span class='error'>Fields must be not empty</span>";
      return $alert;
    } if ($start_date > $end_date){
      $alert = "<span class='error'>Start date is not greater than End date</span>";
      return $alert;
    } else {
      $query = "UPDATE sale SET name='{$saleName}', create_date='{$create_date}', start_date='{$start_date}', end_date='{$end_date}', percent_sale='{$percent_sale}', status='{$status}' WHERE id='{$id}'";
      $result = $this->db->update($query);
      if ($result){
        $alert = "<span class='success'>Update Sale Sucessfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Update Sale Not Sucessfully</span>";
        return $alert;
      }
    }
  }

  public function delete_sale($id)
  {
    $query = "UPDATE sale SET is_deleted='1' WHERE id='{$id}'";
    $result = $this->db->delete($query);
    if ($result) {
      $alert = "<span class='success'>Sale deleted Successfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Provider Delete Not Sucessfully</span>";
      return $alert;
    }
  }
}
?>
