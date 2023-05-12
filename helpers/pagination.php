<?php
class Pagination
{
  public function pageNumber($page_total, $max, $current)
  {
    $half = ceil($max / 2);
    $to = $max;

    if ($current + $half >= $page_total)
      $to = $page_total;
    else if ($current > $half)
      $to = $current + $half;

    $from = $to - $max;
    $result = array();

    for ($i = 1; $i <= $max; $i++) {
      $result[$i] = ($i) + $from;
    }
    return $result;
  }
}


?>

<?php
// $pagination = $pag->pageNumber($page_total, 4, $pagination_id);
// $length = count($pagination);
// for ($i = 1; $i <= $length; $i++) {
//   if ($pagination[$i] > 0) {
//     if ($pagination[$i] == $pagination_id) {
//       $current = "current";
//     } else {
//       $current = "";
//     } 
?>
    <!-- <li class="item <?php echo $current; ?>" id="<?php echo $pagination[$i]; ?>">
                  <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $pagination[$i]; ?>">
                    <?php echo $pagination[$i]; ?>
                  </a>
                </li> -->
<?php
//   }
// }
?>