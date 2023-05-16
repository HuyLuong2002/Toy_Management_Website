<?php
include_once "..\lib\session.php";
Session::init();
if (Session::get("userAdmin") == false) {
  Session::destroy();
}
//Set the default session name
$s_name = session_name();
$timeout = Session::get("timeout");
//Check the session exists or not
if (isset($_COOKIE[$s_name])) {
  setcookie($s_name, $_COOKIE[$s_name], time() + $timeout, "/");
} else {
  Session::destroy();
}
if (isset($_GET["action"]) && $_GET["action"] == "logout") {
  Session::destroy();
}
if (isset($_GET["id"])) {
  $id = $_GET["id"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0" />
  <title>Toy Shop Admin</title>

  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="./css/index.css" />
  <link rel="stylesheet" href="./css/table-list.css" />
  <link rel="stylesheet" href="./css/decentralization.css" />
  <link rel="stylesheet" href="./css/chart.css">
  <!-- <link rel="stylesheet" href="./css/add.css"> -->
  <link rel="stylesheet" href="./css/orderDetail.css">
  <link rel="stylesheet" href="./css/order.css">

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
          <?php echo Session::get("fullname"); ?>
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

  <script src="./js/validate_input.js"></script>

  <!-- coding live search function -->
  <script type="text/javascript">
    $(document).ready(function() {
      $("#search").keyup(function() {
        var input = $(this).val();
        if (checkSearchInput(input) == false) {
          //product
          $("#card-product").html("<span class='error'>Input Value Not Valid</span>");
          $("#card-product").css("display", "block");
          //provider
          $("#card-provider").html("<span class='error'>Input Value Not Valid</span>");
          $("#card-provider").css("display", "block");
          //permission
          $("#card-permission").html("<span class='error'>Input Value Not Valid</span>");
          $("#card-permission").css("display", "block");
          //sale
          $("#card-sale").html("<span class='error'>Input Value Not Valid</span>");
          $("#card-sale").css("display", "block");
          //orders
          $("#card-order").html("<span class='error'>Input Value Not Valid</span>");
          $("#card-order").css("display", "block");
          //account
          $("#card-account").html("<span class='error'>Input Value Not Valid</span>");
          $("#card-account").css("display", "block");
          //inventory
          $("#card-inventory").html("<span class='error'>Input Value Not Valid</span>");
          $("#card-inventory").css("display", "block");
          //category
          $("#card-category").html("<span class='error'>Input Value Not Valid</span>");
          $("#card-category").css("display", "block");
          //inventoryDetail
          $("#card-inventory-detail").html("<span class='error'>Input Value Not Valid</span>");
          $("#card-inventory-detail").css("display", "block");
          return;
        }
        else {
          //product
          $("#card-product").css("display", "none");
          //provider
          $("#card-provider").css("display", "none");
          //permission
          $("#card-permission").css("display", "none");
          //sale
          $("#card-sale").css("display", "none");
          //orders
          $("#card-order").css("display", "none");
          //account
          $("#card-account").css("display", "none");
          //inventory
          $("#card-inventory").css("display", "none");
          //category
          $("#card-category").css("display", "none");
          //inventoryDetail
          $("#card-inventory-detail").css("display", "none");
        }
        if (input != "") {
          $.ajax({
            url: "products.php",
            method: "POST",
            data: {
              input: input
            },
            success: function(data) {
              var $data = $(data);
              var searchResult = $data.find('#card-product').html();
              $("#card-product").html(searchResult);
              $("#card-product").css("display", "block");
            }
          });

          $.ajax({
            url: "providers.php",
            method: "POST",
            data: {
              input: input
            },
            success: function(data) {
              var $data = $(data);
              var searchResult = $data.find('#card-provider').html();
              $("#card-provider").html(searchResult);
              $("#card-provider").css("display", "block");
            }
          });

          $.ajax({
            url: "permission.php",
            method: "POST",
            data: {
              input: input
            },
            success: function(data) {
              var $data = $(data);
              var searchResult = $data.find('#card-permission').html();
              $("#card-permission").html(searchResult);
              $("#card-permission").css("display", "block");
            }
          });

          $.ajax({
            url: "sale.php",
            method: "POST",
            data: {
              input: input
            },
            success: function(data) {
              var $data = $(data);
              var searchResult = $data.find('#card-sale').html();
              console.log(searchResult);
              $("#card-sale").html(searchResult);
              $("#card-sale").css("display", "block");
            }
          });

          $.ajax({
            url: "orders.php",
            method: "POST",
            data: {
              input: input
            },
            success: function(data) {
              var $data = $(data);
              var searchResult = $data.find('#card-order').html();
              $("#card-order").html(searchResult);
              $("#card-order").css("display", "block");
            }
          });

          $.ajax({
            url: "accounts.php",
            method: "POST",
            data: {
              input: input
            },
            success: function(data) {
              var $data = $(data);
              var searchResult = $data.find('#card-account').html();
              $("#card-account").html(searchResult);
              $("#card-account").css("display", "block");
            }
          });

          $.ajax({
            url: "inventory.php",
            method: "POST",
            data: {
              input: input
            },
            success: function(data) {
              var $data = $(data);
              var searchResult = $data.find('#card-inventory').html();
              $("#card-inventory").html(searchResult);
              $("#card-inventory").css("display", "block");
            }
          });

          $.ajax({
            url: "category.php",
            method: "POST",
            data: {
              input: input
            },
            success: function(data) {
              var $data = $(data);
              var searchResult = $data.find('#card-category').html();
              $("#card-category").html(searchResult);
              $("#card-category").css("display", "block");
            }
          });

          $.ajax({
            url: "inventory_detail.php",
            method: "POST",
            data: {
              input: input
            },
            success: function(data) {
              var $data = $(data);
              var searchResult = $data.find('#card-inventory-detail').html();
              $("#card-inventory-detail").html(searchResult);
              $("#card-inventory-detail").css("display", "block");
            }
          });
        } else {
          $("#card-product").css("display", "block");
          $("#card-permission").css("display", "block");
          $("#card-provider").css("display", "block");
          $("#card-sale").css("display", "block");
          $("#card-order").css("display", "block");
          $("#card-account").css("display", "block");
          $("#card-inventory").css("display", "block");
          $("#card-category").css("display", "block");
          $("#card-inventory-detail").css("display", "block");
        }
      });
    });
  </script>