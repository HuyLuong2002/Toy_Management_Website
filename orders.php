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
        <h1 class="heading">Placed Orders</h1>
        <section class="orders">

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
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Lực Nguyễn Tự</td>
                        <td>1041/60 Tran Xuan Soan Quan 7 TPHCM</td>
                        <td>1984160070</td>
                        <td>lucnguyentu45@gmail.com</td>
                        <td>Thanh toán bằng tiền mặt</td>
                        <td class="status-2">PENDING</td>
                        <td>$9,083</td>
                        <td><a href="#" onclick="handleShowDetailOrder(event)">Detail</a></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Lực Nguyễn Tự</td>
                        <td>1041/60 Tran Xuan Soan Quan 7 TPHCM</td>
                        <td>1984160070</td>
                        <td>lucnguyentu45@gmail.com</td>
                        <td>Thanh toán bằng tiền mặt</td>
                        <td class="status-1">DELIVERING</td>
                        <td>$9,083</td>
                        <td><a href="#" onclick="handleShowDetailOrder(event)">Detail</a></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Lực Nguyễn Tự</td>
                        <td>1041/60 Tran Xuan Soan Quan 7 TPHCM</td>
                        <td>1984160070</td>
                        <td>lucnguyentu45@gmail.com</td>
                        <td>Thanh toán bằng tiền mặt</td>
                        <td class="status-0">SHIPPED</td>
                        <td>$9,083</td>
                        <td><a href="#" onclick="handleShowDetailOrder(event)">Detail</a></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>

    <div class="modal" id="modal">
        <div class="container-oder-detail">
            <span onclick="handleClose()">&times;</span>
            <h1 style="text-align: center; margin-bottom: 1rem;">Order Detail</h1>

            <div class="content-oder">
                <div class="order-list">
                    <ul class="name-order-list" style="font-weight: 600;">
                        <li>Product</li>
                        <li>Name</li>
                        <li>Price</li>
                        <li>Quantity</li>
                        <li>TotalPrice</li>
                    </ul>
                </div>   
                <div class="order-product">
                    <img src="./assets/images/home-img-1.png" alt="">
                    <p class="product_name">Product 1</p>
                    <p class="product_price">$3000</p>
                    <P class="product_quantity">3</P>
                    <P class="product_total">$9000</P>
                </div>
                <div class="order-product">
                    <img src="./assets/images/home-img-1.png" alt="">
                    <p class="product_name">Product 1</p>
                    <p class="product_price">$3000</p>
                    <P class="product_quantity">3</P>
                    <P class="product_total">$9000</P>
                </div>
                
                <hr style="border-top: 3px solid #ccc;">
            </div>

            <div class="ship-info-order">
                <p style="font-size: 1.5rem;">Billing: </p>
                <div class="wrap-order-container">
                    <div class="wrap-order-info">
                        <p>Name: <span>Nguyen Tu Luc</span></p>
                        <p>Email: <span>luc@gmail.com</span></p>
                        <p>Phone: <span>0984160070</span></p>
                        <p>Address: <span>1041/60 Tran Xuan Soan</span></p>
                        <p>Country: <span>VietNam</span></p>
                    </div>
                    <div class="wrap-order-info">
                        <p>VAT(10%): <span>$300</span></p>
                        <p>Ship Method: <span>Express $12</span></p>
                        <p>Payment Method: <span>payment in cash</span></p>
                        <p style="font-size: 2rem;">Total Price: <span>$3342</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let modal = document.getElementById("modal");
        const handleClose = () => {
            modal.style.display = "none";
        }
        const handleShowDetailOrder = (event) => {
            event.preventDefault();


        }
    </script>

    <?php
    include("./components/footer.php");
    ?>