<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\helpers\\format.php";
?>

<?php class Product
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  //list product for home page
  public function show_product_user()
  {
    $query = "SELECT * FROM product, category, sale WHERE product.category_id = category.id and product.sale_id = sale.id
      ORDER BY product.create_date DESC";
    $result = $this->db->select($query);
    return $result;
  }

  //list product by category id
  public function show_product_by_category_id($category_id)
  {
    $query = "SELECT * FROM product, category, sale WHERE product.category_id = category.id and product.sale_id = sale.id and product.category_id = '$category_id'
    ORDER BY product.create_date DESC";
    $result = $this->db->select($query);
    return $result;
  }
  //list product by category id have off and limit
  public function show_product_by_category_panigation($category_id, $offset, $limit_per_page)
  {
    $query = "SELECT * FROM product, category, sale WHERE product.category_id = category.id and product.sale_id = sale.id and product.category_id = '$category_id'
    ORDER BY product.create_date DESC LIMIT $offset,$limit_per_page";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product()
  {
    $query = "SELECT * FROM product ORDER BY id desc";
    $result = $this->db->select($query);
    return $result;
  }

  public function get_product_by_id($id)
  {
    $query = "SELECT * FROM product WHERE id = '$id'";
    $result = $this->db->select($query);
    return $result;
  }
  //live search for admin
  public function show_product_live_search($input)
  {
    $query = "SELECT * FROM product, category, sale WHERE ((product.name LIKE '$input%') OR (product.price LIKE '$input%') OR (product.description LIKE '$input%') OR (product.create_date LIKE '$input%') OR (product.highlight LIKE '$input%') OR (product.category_id LIKE '$input%') OR (product.sale_id LIKE '$input%') OR (product.review LIKE '$input%') OR (product.quantity LIKE '$input%')) AND (category.id = product.category_id AND sale.id = product.sale_id)";
    $result = $this->db->select($query);
    return $result;
  }

  public function insert_product($data, $files)
  {
    $productName = mysqli_real_escape_string($this->db->link, $data["name"]);
    $category = mysqli_real_escape_string($this->db->link, $data["category"]);
    $sale = mysqli_real_escape_string($this->db->link, $data["sale"]);
    $description = mysqli_real_escape_string(
      $this->db->link,
      $data["description"]
    );
    $price = mysqli_real_escape_string($this->db->link, $data["price"]);
    $quantity = mysqli_real_escape_string($this->db->link, $data["quantity"]);
    $create_date = (string) date("d/m/Y");
    $highlight = 0;
    $review = 0;
    //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
    $permited = ["jpg", "jpeg", "png", "gif"];
    $file_name = $_FILES["uploadfile"]["name"];
    $file_size = $_FILES["uploadfile"]["size"];
    $file_temp = $_FILES["uploadfile"]["tmp_name"];

    $div = explode(".", $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . "." . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;

    if (
      $productName == "" ||
      $sale == "" ||
      $category == "" ||
      $description == "" ||
      $price == "" ||
      $quantity == "" ||
      $file_name == ""
    ) {
      $alert = "<span class='error'>Fields must be not empty</span>";
      return $alert;
    } else {
      move_uploaded_file($file_temp, $uploaded_image);
      $query = "INSERT INTO product(name, image, price, description, create_date, highlight, category_id, sale_id, review, quantity) VALUES ('$productName', '$unique_image', '$price', '$description', '$create_date', $highlight, $category, $sale, $review, $quantity)";
      $result = $this->db->insert($query);
      if ($result) {
        $alert = "<span class='success'>Insert Product Sucessfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Insert Product Not Sucessfully</span>";
        return $alert;
      }
    }
  }
}
?>
