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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link rel="stylesheet" href="./assets/css/payment.css">
    <title>Place An Order</title>
</head>

<body>
    <a href="./payment.php" class="return-btn">
        <i class="fa-solid fa-arrow-left fa-2xs"></i>
    </a>
    <div id="wrap">
        <div id="grid">
            <div class="column4" id="col-4">
                <div class="step" id="step5">
                    <div class="number">
                        <span>4</span>
                    </div>
                    <div class="title">
                        <h1>Finalize Order</h1>
                    </div>
                    <div class="modify">
                        <i class="fa fa-plus-circle"></i>
                    </div>
                </div>
                <div class="content" id="final_products">
                    <div class="left" id="ordered">
                        <div class="wrap-product-left" id="wrap-product-left">
                            <table id="container-product-left">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>TotalPrice</th>
                                    </tr>
                                </thead>
                                <tbody id="content-container-product-left">
                                
                                </tbody>
                            </table>
                            <!-- render product -->
                        </div>
                        
                        <div class="wrap-totals" id="wrap-totals">
                            <!-- calculate total -->
                        </div>
                    </div>
                    <div class="right" id="reviewed">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/placeAnOrder.js"></script>
    <script>
        let shipInfo = JSON.parse(localStorage.getItem('shipInfo'));
        let reviewed = document.getElementById("reviewed")

        reviewed.innerHTML = `
            <div class="billing">
                <span class="title">Billing:</span>
                <div class="address_reviewed">
                    <span class="name">${shipInfo.first_name} ${shipInfo.last_name}</span>
                    <span class="email">${shipInfo.email}</span>
                    <span class="address">${shipInfo.address}</span>
                    <span class="location">${shipInfo.country}</span>
                    <span class="phone">${shipInfo.telephone}</span>
                </div>
            </div>
            <div class="shipping">
                <span class="title">Shipping:</span>
                <div class="address_reviewed">
                    <span class="name">${shipInfo.first_name} ${shipInfo.last_name}</span><br/>
                    <span class="address">${shipInfo.address}</span><br/>
                    <span class="location">${shipInfo.country}</span><br/>
                    <span class="phone">${shipInfo.telephone}</span><br/>
                    <span class="shipMethod">${shipInfo.shipMethod}</span>
                </div>
            </div>
            <div class="payment">
                <span class="title">Payment:</span>
                <div class="payment_reviewed">
                    <span class="method">${shipInfo.paymentMethod}</span>
                    <span class="number_hidden"></span>
                </div>
            </div>
            <div id="complete">
                <a class="big_button" id="complete" href="cart.php" onclick="handlePlaceAnOrder(<?php echo $user_id ?>)">Complete Order</a>
                <span class="sub">By selecting this button you agree to the purchase and subsequent payment for this order.</span>
            </div>
        `

        const handlePlaceAnOrder = (userId) => {
            var expireDate = new Date();
            expireDate.setDate(expireDate.getDate() + 3);
            let totalPrice = document.getElementById("calculated_total").innerText
            let Order = {
                user_id: userId,
                first_name: shipInfo.first_name,
                last_name: shipInfo.last_name,
                telephone: shipInfo.telephone,
                address: shipInfo.address,
                email: shipInfo.email,
                paymentMethod:  shipInfo.paymentMethod,
                shipMethod: shipInfo.shipMethod,
                discount: shipInfo.paymentMethod,
                country:  shipInfo.country,
                totalPrice:  parseFloat(totalPrice.slice(1)),
                vat: shipInfo.vat,
                product: CartAdd
            }
            localStorage.setItem("Order", JSON.stringify(Order));
            document.cookie = "Order=" + JSON.stringify(Order) + "; expires=" + expireDate.toUTCString() + "; path=/";
            localStorage.setItem('cartAdd', JSON.stringify([]));
        }
    </script>
</body>

</html>