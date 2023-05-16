<?php
/**
 * Format Class
 */
class Format
{
  public function formatDate($date)
  {
    return date("Y-m-d", strtotime($date));
  }

  public function formatDateReverse($date)
  {
    if (!empty($date)){
      $new_date = DateTime::createFromFormat("d/m/Y", $date)->format("Y-m-d");
    }
    else {
      $new_date = "2000-01-01";
    }
    return $new_date;
  }

  public function CheckGender($gender)
  {
    if(!empty($gender)){
      $gender = strtolower($gender);
    } 
    else {
      $gender = "";
    }
    return $gender;
  }

  public function textShorten($text, $limit = 400)
  {
    if(strlen($text) > $limit)
    {
      $text = $text . " ";
      $text = substr($text, 0, $limit);
      $text = substr($text, 0, strrpos($text, " "));
      $text = $text . ".....";
      return $text;
    }
    return $text;
  }

  public function validation($data)
  {
    $data = trim($data);
    $data = stripcslashes($data); //Hàm loại bỏ dấu gạch chéo
    $data = htmlspecialchars($data);
    /* Hàm chuyển đổi các ký tự đặc biệt
     trong dữ liệu thành các thực thể HTML tương ứng. */
    return $data;
  }

  public function title()
  {
    $path = $_SERVER["SCRIPT_FILENAME"];
    //Lấy tên tập tin không cần phần mở rộng .php
    $title = basename($path, ".php");
    //$title = str_replace('_', ' ', $title);
    if ($title == "index") {
      $title = "home";
    } elseif ($title == "contact") {
      $title = "contact";
    }
    /* để đưa chữ cái đầu tiên của chuỗi thành chữ in hoa và
     trả về tiêu đề của trang */
    return $title = ucfirst($title);
  }

  public function convertToVND($price)
  {
    $vnd = number_format($price, 0, ",", ".");
    return $vnd . " VNĐ";
  }

  public function formatPriceDecimal($price)
  {
    $vnd = number_format($price, 0, ",", ".");
    return $vnd;
  }
}
