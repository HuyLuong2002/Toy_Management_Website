<?php
/**
 * Format Class
 */
class Format
{
  public function formatDate($date)
  {
    return date("F j, Y, g:i a", strtotime($date));
  }

  public function textShorten($text, $limit = 400)
  {
    $text = $text . " ";
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, " "));
    $text = $text . ".....";
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
    return $vnd . " đ";
  }
}
?>
