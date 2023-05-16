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
    <link rel="stylesheet" href="./assets/css/home.css">
    <link rel="stylesheet" href="./assets/css/slide.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/orders.css">

</head>

<body>

    <?php
    include_once("./components/header.php");
    ?>

    <div class="wrap-oder">
        
        <h2 class="heading" style="text-align: center;">Placed Orders</h2>

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