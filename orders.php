<?php
include_once "./lib/session.php";

Session::init();
$user_id = Session::get("userID");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="./assets/css/orders.css">
    <link rel="stylesheet" href="./assets/css/home.css">
    <link rel="stylesheet" href="./assets/css/slide.css">
    <link rel="stylesheet" href="./assets/css/footer.css">

</head>

<body>

    <?php
    include_once("./components/header.php");
    ?>

    <div class="wrap-oder">
        <div class="wrap-head-table">
            <h2 class="heading">Placed Orders</h2>
            <div class="wrap-date-choose">
                <div class="data-choose">
                    <h4>Tìm khoảng thời gian</h4>
                    <form>
                    <div class="wrap-date">
                        <div class="start-date">
                        <label for="start_date">Ngày bắt đầu:</label>
                        <input type="date" id="start_date" name="start_date" required dateFormat="yyyy-mm-dd">
                        </div>

                        <div class="end-date">
                        <label for="end_date">Ngày kết thúc:</label>
                        <input type="date" id="end_date" name="end_date" required dateFormat="yyyy-mm-dd">
                        </div>
                    </div>

                    <button id="search-btn" class="btn-form" type="submit" onclick="validateDateInputs(event)">Tìm</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="check-date" id="check-fail">
            <span>&times;</span> Failed
        </div>

        <section class="orders" id="orders">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name Customer</th>
                        <th>Address</th>
                        <th>Phone number</th>
                        <th>Email</th>
                        <th>Payment method</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="body_orders">

                </tbody>
            </table>
        </section>


    </div>

    <div class="modal" id="modal">
        <div class="container-oder-detail">
            <span onclick="handleClose()">&times;</span>

            <h1 style="text-align: center; margin-bottom: 1rem;">Order Detail</h1>

            <div class="content-order">
                <div class="wrap-order-detail-table">
                    <table id="content-order-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>TotalPrice</th>
                            </tr>
                        </thead>
                        <tbody id="wrap-load-order-product">
                            
                        </tbody>
                    </table>
                </div>

                <hr style="border-top: 3px solid #ccc;">

                <div class="ship-info-order" id="ship-info-order">
                    
                </div>
            </div>
        </div>
    </div>

<script src="./js/orders.js"></script>

<?php
include("./components/footer.php");
?>