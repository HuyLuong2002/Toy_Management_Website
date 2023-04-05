<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\Toy_Management_Website\lib\session.php";
if(isset($_GET["action"]) && $_GET["action"] == "logout")
{
    Session::destroy();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="./assets/css/home.css" />
  <!-- <link rel="stylesheet" href="./assets/css/product_collection.css" /> -->
  <link rel="stylesheet" href="./assets/css/product_list.css" />
  <link rel="stylesheet" href="./assets/css/slide.css" />
  <link rel="stylesheet" href="./assets/css/footer.css" />
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>

<body>
  <?php
  include_once("./components/header.php");
  include_once("./home.php");
  include_once("./components/footer.php");
  ?>

  <!-- font awesome cdn link  -->
  <script src="https://kit.fontawesome.com/1b6e53cabd.js" crossorigin="anonymous"></script>
  <script src="./js/home.js"></script>
  <script src="./js/wishlist.js"></script>
</body>
  
</html>