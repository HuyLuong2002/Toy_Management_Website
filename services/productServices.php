<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
?>

<?php class ProductServices
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  //list product for home page
  public function show_product_user()
  {
    $query = "SELECT * FROM product, category, sale WHERE product.category_id = category.id and product.sale_id = sale.id and product.is_deleted = '0'
      ORDER BY product.create_date DESC";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_slider_product()
  {
    $query = "SELECT * FROM product WHERE product.highlight = '1' AND is_deleted='0'
    ORDER BY product.create_date DESC";
    $result = $this->db->select($query);
    return $result;
  }

  // product detail by product id
  public function show_product_detail($product_detail_id)
  {
    $query = "SELECT * FROM product, category, sale WHERE product.category_id = category.id and product.sale_id = sale.id and product.id = '$product_detail_id'";
    $result = $this->db->select($query);
    return $result;
  }

  //list product by category id
  public function show_product_by_category_id($category_id)
  {
    $query = "SELECT * FROM product, category, sale WHERE product.category_id = category.id and product.sale_id = sale.id and product.category_id = '$category_id' and product.is_deleted = '0'
    ORDER BY product.create_date DESC";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_live_search_category_id($id)
  {
    $query = "SELECT * FROM product, category WHERE product.category_id = category.id and product.category_id = '$id' and product.is_deleted = '0'
    ORDER BY product.create_date DESC";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_by_category_id_unique($id)
  {
    $query = "SELECT * FROM product, category, sale WHERE product.id != '$id' 
    AND product.is_deleted = '0'
    AND product.category_id = category.id
    AND product.sale_id = sale.id
    ORDER BY product.create_date DESC LIMIT 4";
    $result = $this->db->select($query);
    return $result;
  }

  //list product by category id have off and limit
  public function show_product_by_category_panigation(
    $category_id,
    $offset,
    $limit_per_page
  ) {
    $query = "SELECT * FROM product, category, sale WHERE product.category_id = category.id and product.sale_id = sale.id and product.category_id = '$category_id' and product.is_deleted = '0'
    ORDER BY product.create_date DESC LIMIT $offset,$limit_per_page";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_by_panigation_admin($offset, $limit_per_page)
  {
    $query = "SELECT * FROM product, category, sale WHERE product.category_id = category.id and product.sale_id = sale.id and product.is_deleted = '0'
    ORDER BY product.create_date DESC LIMIT $offset,$limit_per_page";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_sort($sortKey)
  {
    if ($sortKey == 1) {
      $query = "SELECT * FROM product, category, sale WHERE product.is_deleted = 0 
      AND product.category_id = category.id 
      AND product.sale_id = sale.id
      ORDER BY product.name DESC";
    } else {
      $query = "SELECT * FROM product, category, sale WHERE product.is_deleted = 0
      AND product.category_id = category.id
      AND product.sale_id = sale.id
      ORDER BY product.name ASC";
    }
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product()
  {
    $query =
      "SELECT * FROM product WHERE product.is_deleted = '0' ORDER BY id desc LIMIT 5";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_receipt()
  {
    $query =
      "SELECT * FROM product WHERE product.is_deleted = '0' ORDER BY id desc";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_for_pagination()
  {
    $query =
      "SELECT * FROM product, category, sale WHERE product.is_deleted = '0' AND product.category_id = category.id AND product.sale_id = sale.id ORDER BY product.create_date desc";
    $result = $this->db->select($query);
    return $result;
  }

  public function get_product_by_id($id)
  {
    $query = "SELECT * FROM product WHERE id = '{$id}'";
    $result = $this->db->select($query);
    return $result;
  }

  //live search for admin
  public function show_product_live_search($input)
  {
    $query = "SELECT * FROM product, category, sale WHERE ((product.name LIKE '%$input%') OR (product.price LIKE '%$input%') OR (product.description LIKE '%$input%') OR (product.create_date LIKE '%$input%') OR (product.highlight LIKE '%$input%') OR (sale.name LIKE '%$input%') OR (category.name LIKE '%$input%') OR (product.review LIKE '%$input%') OR (product.quantity LIKE '%$input%')) AND (category.id = product.category_id AND sale.id = product.sale_id AND product.is_deleted = '0')";
    $result = $this->db->select($query);
    return $result;
  }

  //live search for user
  public function show_product_live_search_category($input)
  {
    $query = "SELECT * FROM product, category WHERE (category.name LIKE '%$input%') AND (category.id = product.category_id AND product.is_deleted = '0')";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_live_search_price($input)
  {
    $query = "SELECT * FROM product WHERE (price LIKE '%$input%' AND product.is_deleted = '0') LIMIT 4";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_live_search_price_lower_500()
  {
    $query = "SELECT * FROM product WHERE (price < 500 AND product.is_deleted = '0')";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_live_search_price_from_500_to_1000()
  {
    $query = "SELECT * FROM product WHERE (price >= 500 AND price <= 1000 AND product.is_deleted = '0')";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_live_search_price_from_1000_to_2000()
  {
    $query = "SELECT * FROM product WHERE (price >= 1000 AND price <= 2000 AND product.is_deleted = '0')";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_live_search_price_greater_2000()
  {
    $query = "SELECT * FROM product WHERE (price > 2000 AND product.is_deleted = '0')";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_live_search_rating_1()
  {
    $query = "SELECT * FROM product WHERE (review = 1 AND product.is_deleted = '0')";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_live_search_rating_2()
  {
    $query = "SELECT * FROM product WHERE (review = 2 AND product.is_deleted = '0')";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_live_search_rating_3()
  {
    $query = "SELECT * FROM product WHERE (review = 3 AND product.is_deleted = '0')";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_live_search_rating_4()
  {
    $query = "SELECT * FROM product WHERE (review = 4 AND product.is_deleted = '0')";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_live_search_rating_5()
  {
    $query = "SELECT * FROM product WHERE (review = 5 AND product.is_deleted = '0')";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_live_search_name($input)
  {
    $query = "SELECT * FROM product WHERE (name LIKE '%$input%' AND product.is_deleted = '0')";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_product_live_search_rating($input)
  {
    $query = "SELECT * FROM product WHERE (review LIKE '%$input%' AND product.is_deleted = '0')";
    $result = $this->db->select($query);
    return $result;
  }

  public function insert_product($data)
  {
    $productName = mysqli_real_escape_string($this->db->link, $data["name_add"]);
    $category = mysqli_real_escape_string($this->db->link, $data["category_add"]);
    $sale = mysqli_real_escape_string($this->db->link, $data["sale_add"]);
    $description = mysqli_real_escape_string(
      $this->db->link,
      $data["description_add"]
    );
    $price = mysqli_real_escape_string($this->db->link, $data["price_add"]);
    $quantity = mysqli_real_escape_string($this->db->link, $data["quantity_add"]);
    $create_date = (string) date("Y-m-d");
    $highlight = 0;
    $review = 0;
    //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
    $permited = ["jpg", "jpeg", "png", "gif"];
    $file_name = $_FILES["uploadfile_add"]["name"];
    $file_size = $_FILES["uploadfile_add"]["size"];
    $file_temp = $_FILES["uploadfile_add"]["tmp_name"];

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
      $query = "INSERT INTO product(name, image, price, description, create_date, highlight, category_id, sale_id, review, quantity, is_deleted) VALUES ('$productName', '$unique_image', '$price', '$description', '$create_date', $highlight, $category, $sale, $review, $quantity, '0')";
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
  public function update_product($data, $id)
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
    $create_date = (string) date("Y-m-d");

    //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
    $permited = ["jpg", "jpeg", "png", "gif"];
    $file_name = $_FILES["uploadfile"]["name"];
    $file_size = $_FILES["uploadfile"]["size"];
    $file_temp = $_FILES["uploadfile"]["tmp_name"];

    $div = explode(".", $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . "." . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;

    echo var_dump($unique_image);

    if (
      $productName == "" ||
      $sale == "" ||
      $category == "" ||
      $price == "" ||
      $quantity == "" ||
      $file_name == ""
    ) {
      $alert = "<span class='error'>Fields must be not empty</span>";
      return $alert;
    } else {
      move_uploaded_file($file_temp, $uploaded_image);
      $query = "UPDATE product SET name='{$productName}', image='{$unique_image}', price='{$price}', description='{$description}', create_date='{$create_date}', category_id='{$category}', sale_id='{$sale}' where id='{$id}'";

      $result = $this->db->update($query);
      if ($result) {
        $alert = "<span class='success'>Update Product Sucessfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Update Product Not Sucessfully</span>";
        return $alert;
      }
    }
  }

  public function update_product_highlight($highlight, $id)
  {
    $query = "UPDATE product SET highlight='{$highlight}' WHERE id='{$id}'";
    $result = $this->db->update($query);
    return $result;
  }

  public function delete_product($id)
  {
    $query = "UPDATE product SET is_deleted='1' WHERE id='{$id}'";
    $result = $this->db->delete($query);
    if ($result) {
      $alert = "<span class='success'>Product Deleted Sucessfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Product Delete Not Sucessfully</span>";
      return $alert;
    }
  }
}
?>
