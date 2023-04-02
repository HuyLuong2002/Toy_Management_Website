<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\lib\session.php";
Session::checkSession();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0" />
  <title>Toy Shop Admin</title>

  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
  <link rel="stylesheet" href="./css/index.css" />
  <link rel="stylesheet" href="./css/index.css" />
  <link rel="stylesheet" href="./css/table-list.css" />
  <link rel="stylesheet" href="./css/decentralization.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>

  <header id="header">
    <h2>
      <label for="nav-toggle">
        <span class="las la-bars"> </span>
      </label>
      Dashboard
    </h2>

    <div class="admin-search-wrapper">
      <span class="las la-search"></span>
      <input type="text" placeholder="Search here" id="search" autocomplete="off" />
    </div>

    <div class="admin-user-wrapper">
      <img src="assets/images/pic-1.png" width="40px" height="40px" alt="" />
      <div>
        <h4>
          <?php echo Session::get("adminName"); ?>
          <small>Super admin</small>
          <small>
            <?php if (isset($_GET["action"]) && $_GET["action"] == "logout") {
              Session::destroy();
            } ?>
            <a href="?action=logout">Đăng xuất</a>
          </small>
        </h4>
      </div>
    </div>
  </header>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#search").keyup(function(){
        var input = $(this).val();
        
        if(input != "") {
          $.ajax({
            url: "products.php",
            method: "POST",
            data:{input:input},
            success: function(data){
              $("#searchresult").html(data);
              $("#searchresult").css("display","block");
            }
          });
        }
        else
        {
          $("#searchresult").css("display","none");
        }
      });
    });
  </script>
