<?php
    class Pagination{
        public function pageNumber($page_total, $max, $current){
            $half = ceil($max / 2);
            $to = $max;
        
            if ($current + $half >= $page_total)
              $to = $page_total;
            else if ($current > $half)
              $to = $current + $half;
        
              $from = $to - $max;
              $result = array();
        
              for ($i = 1; $i <= $max; $i++){
                $result[$i] = ($i) + $from;
              }
              return $result;
          }
    }
?>