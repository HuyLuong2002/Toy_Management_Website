<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/payment.css">
    <title>Place An Order</title>
</head>

<body>
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
                            <!-- render product -->
                        </div>
                        
                        <div class="wrap-totals" id="wrap-totals">
                            <!-- calculate total -->
                        </div>
                    </div>
                    <div class="right" id="reviewed">
                        <div class="billing">
                            <span class="title">Billing:</span>
                            <div class="address_reviewed">
                                <span class="name">John Smith</span>
                                <span class="address">123 Main Street</span>
                                <span class="location">Everytown, USA, 12345</span>
                                <span class="phone">(123)867-5309</span>
                            </div>
                        </div>
                        <div class="shipping">
                            <span class="title">Shipping:</span>
                            <div class="address_reviewed">
                                <span class="name">John Smith</span>
                                <span class="address">123 Main Street</span>
                                <span class="location">Everytown, USA, 12345</span>
                                <span class="phone">(123)867-5309</span>
                            </div>
                        </div>
                        <div class="payment">
                            <span class="title">Payment:</span>
                            <div class="payment_reviewed">
                                <span class="method">Visa</span>
                                <span class="number_hidden">xxxx-xxxx-xxxx-1111</span>
                            </div>
                        </div>
                        <div id="complete">
                            <a class="big_button" id="complete" href="#">Complete Order</a>
                            <span class="sub">By selecting this button you agree to the purchase and subsequent payment for this order.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/placeAnOrder.js"></script>
</body>

</html>