<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\Toy_Management_Website\classes\category.php";

$category = new Category();
if (isset($_GET["id"])) {
  $category_id = $_GET["id"];
} else {
    $category_id = '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/category.css">
    <link rel="stylesheet" href="./assets/css/home.css" />
    <link rel="stylesheet" href="./assets/css/slide.css">
    <link rel="stylesheet" href="./assets/css/footer.css" />
</head>

<body>
    <?php include_once "./components/header.php"; ?>
    <div class="page-wrapper">
        <div class="breadcrumbs">
            <div class="container">
                <ul class="items">
                    <li class="item"><i class="fa-solid fa-house"></i><a href="index.php">Home</a></li>
                    <?php
                    $show_category_by_id = $category->show_category_by_id(
                      $category_id
                    );
                    if ($show_category_by_id) {
                      $result = $show_category_by_id->fetch_assoc(); ?>
                    <li class="item"><a href="category.php?id=<?php echo $result[
                      "id"
                    ]; ?>"><?php echo $result["name"]; ?></a></li>
                                <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="main-container">
            <div class="sidebar">
                <div class="sidebar-category">
                    <h3 class="title">Category</h3>
                    <ul class="main-list">
                        <?php
                        $show_category = $category->show_category();
                        if ($show_category) {
                          while ($result = $show_category->fetch_assoc()) { ?>
                        <li>
                            <a href="category.php?id=<?php echo $result[
                              "id"
                            ]; ?>"><?php echo $result["name"]; ?></a>
                        </li>
                        <?php }
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="list-product">
                <div class="product-wrapper">
                    <div class="catalog-product-item">
                        <div class="product-content">
                            <div class="product-img-box">
                                <img src="./assets/images/home-img-1.png" class="product-img">
                            </div>
                            <div class="product-btns">
                                <button class="btn-cart">
                                    Add to Cart
                                    <span><i class="fas fa-plus"></i></span>
                                </button>
                                <button class="btn-buy">
                                    Buy now
                                    <span><i class="fas fa-shopping-cart"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-info-top">
                                <h2 class="sm-title">Đồ chơi búp bê</h2>
                                <div class="rating">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                </div>
                            </div>
                            <a href="" class="product-name">Product 1</a>
                            <p class="product-price product-price-linet">$4000</p>
                            <p class="product-price product-price-sale">$3000</p>
                        </div>
                        <div class="off-info">
                            <h2 class="sm-title">Sale 25%</h2>
                        </div>
                    </div>

                    <div class="bottom-pagination">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "./components/footer.php"; ?>
</body>
<script>
    $(document).ready(function() {
        // alert("Hello, world!");
        $('.sub-list').parent('li').addClass('has-child');
        
    });
</script>