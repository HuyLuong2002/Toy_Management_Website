<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\Toy_Management_Website\controller\productsController.php";

$productsController = new ProductsController();

if (isset($_POST["page"])) {
    $page_id = $_POST["page"];
    settype($page_id, "int");
} else {
    $page_id = 1;
}

if (isset($_POST["category_id"])) {
    $category_id = $_POST["category_id"];
    settype($category_id, "int");
}

$result_pagination = $productsController->show_product_by_category_id(
    $category_id
);

if ($result_pagination != false) {
    /*
    Tính giá trị của phân trang
    10 sản phẩm trên 1 trang
    */
    // Tổng số sản phẩm
    $product_total = mysqli_num_rows($result_pagination);
    //số sản phẩm trên 1 trang
    $num_product_on_page = 9;
    $page_total = ceil($product_total / $num_product_on_page);
    //Trang hiện tại
    $current_page = $page_id;
    // vị trí hiện tại
    $current_position = ($current_page - 1) * $num_product_on_page;
    $result_pagination = $productsController->show_product_by_category_panigation(
        $category_id,
        $current_position,
        $num_product_on_page
    );
}
?>
<div class="product-wrapper">
    <?php if ($result_pagination) {
        while ($result_product = $result_pagination->fetch_array()) { ?>
            <div class="catalog-product-item">
                <div class="product-content">
                    <a href="product_detail.php?id=<?php echo $result_product[0]; ?>&categoryID=<?php echo $result_product[7]; ?>">
                        <div class="product-img-box">
                            <img src="<?php echo " admin/uploads/" .
                                            $result_product[2]; ?>" alt="" id="product-image-<?php echo $result_product[0]; ?>" />
                        </div>
                    </a>
                    <div class="product-btns">
                        <button class="btn-cart" onclick="AddActive(event, <?php echo $result_product[0]; ?>)">
                            Add to Cart
                            <span><i class="fa-solid fa-plus add-icon" id="icon-check-<?php echo $result_product[0]; ?>"></i></span>
                        </button>
                        <a href="product_detail.php?id=<?php echo $result_product[0]; ?>&categoryID=<?php echo $result_product[7]; ?>">
                            <button class="btn-buy">
                                More Details
                                <span><i class="fa-solid fa-circle-info"></i> </span>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-info-top">
                        <h2 class="sm-title">
                            <?php echo $result_product[13]; ?>
                        </h2>
                        <div class="rating">
                            <?php
                            $rating = $result_product[9];
                            for ($i = 0; $i < 5; $i++) {
                                if ($rating > $i) {
                                    echo "<span><i class='fas fa-star'></i></span>";
                                } else {
                                    echo "<span><i class='far fa-star'></i></span>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <a href="product_detail.php?id=<?php echo $result_product[0]; ?>" class="product-name" id="product-name-<?php echo $result_product[0]; ?>">
                        <?php echo $result_product[1]; ?>
                    </a>
                    <?php echo $result_product[16] !== "Không áp dụng"
                        ? "<p class='product-price product-price-linet' id='product-price-<?php echo $result_product[0]; ?>'>$$result_product[3]</p>"
                        : ""; ?>
                    <p class="product-price product-price-sale" id="product-price-<?php echo $result_product[0]; ?>">
                        <?php if ($result_product[16] !== "Không áp dụng") {
                            $sale_percent = $result_product[20];
                            $sale_price =
                                $result_product[3] -
                                $result_product[3] * ($sale_percent / 100);
                            echo "$" . $sale_price;
                        } else {
                            echo "$" . $result_product[3];
                        } ?>
                    </p>
                </div>
                <div class="off-info">
                    <?php if ($result_product[16] === "Không áp dụng") {
                        echo "";
                    } else {
                        $sale_percent = $result_product[20];
                        echo "<h2 class='sm-title'>Sale $sale_percent%</h2>";
                    } ?>

                    <div class="favorite-icon" onclick="AddFavorite(event, <?php echo $result_product[0]; ?>)">
                        <i class="fa-regular fa-heart fav-icon" id="favorite-<?php echo $result_product[0]; ?>" data-id="<?php echo $result_product[0]; ?>"></i>
                    </div>
                </div>
            </div>
    <?php }
    } else {
        echo "<h2>No Record Found. </h2>";
    } ?>
</div>
<?php
if ($page_total > 1) {
?>
    <div class="bottom-pagination">
        <ul class="pagination" id="pagination">

            <?php if ($current_page > 3) {
                $first_page = 1;
            ?>
                <li class="item first-page" id="<?php echo $first_page ?>">
                    <a class="pagination_link">
                        First
                    </a>
                </li>
            <?php } ?>

            <?php if ($current_page > 3) { ?>
                <li class="item prev-page" id="<?php echo $current_page - 1 ?>">
                    <a class="pagination_link">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </li>
            <?php } ?>

            <?php
            for ($num = 1; $num <= $page_total; $num++) {
                if ($num != $current_page) {
                    if ($num > $current_page - 3 && $num < $current_page + 3) {
            ?>
                        <li class="item" id="<?php echo $num; ?>">
                            <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $num ?>">
                                <?php echo $num; ?>
                            </a>
                        </li>
                    <?php
                    }
                } else {
                    ?>
                    <li class="item <?php echo "current" ?>" id="<?php echo $num; ?>">
                        <a class="pagination_link">
                            <?php echo $num; ?>
                        </a>
                    </li>
            <?php
                }
            }
            ?>

            <?php if ($current_page <= $page_total - 3) { ?>
                <li class="item next-page" id="<?php echo $current_page + 1 ?>">
                    <a class="pagination_link">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </li>
            <?php }
            ?>

            <?php if ($current_page <= $page_total - 3) {
                $lastpage = $page_total;
            ?>
                <li class="item last-page" id="<?php echo $lastpage ?>">
                    <a class="pagination_link">
                        Last
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php
}
?>

<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({

        });
    });
</script>