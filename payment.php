<?php
$filepath = realpath(dirname(__DIR__));
include "./lib/session.php";
include_once($filepath . "\Toy_Management_Website\controller\accountController.php");


Session::init();
$user_id = Session::get("userID");
if (empty($user_id)) {
    header("Location: login.php");
}

$accountController = new AccountController();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="./assets/css/payment.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>

<body>
    <div class="payment_container">
        <div id="wrap">
            <div id="grid">

                <div class="swiper-container">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="swiper-center">

                                <div class="column column1" id="col-1">
                                    <div class="step" id="step2">
                                        <div class="number">
                                            <span>1</span>
                                        </div>
                                        <div class="title">
                                            <h1>Information</h1>
                                        </div>
                                    </div>
                                    <div class="content" id="address">


                                        <!--  -->
                                        <?php
                                        $show_account = $accountController->show_account_by_id($user_id);
                                        if ($show_account) {
                                            while ($result_account = $show_account->fetch_array()) {
                                        ?>


                                                <form class="go-right" id="form_1">
                                                    <div>
                                                        <input type="name" name="first_name" value="<?php echo $result_account[3] ?>" id="first_name" placeholder="First Name" data-trigger="change" data-validation-minlength="1" data-type="name" data-required="true" data-error-message="Enter Your First Name" /><label for="first_name">First Name</label>
                                                    </div>

                                                    <div>
                                                        <input type="name" name="last_name" value="<?php echo $result_account[4] ?>" id="last_name" placeholder="Last Name" data-trigger="change" data-validation-minlength="1" data-type="name" data-required="true" data-error-message="Enter Your Last Name" /><label for="last_name">Last Name</label>
                                                    </div>
                                                    <div>
                                                        <input type="phone" name="telephone" value="" id="telephone" placeholder="Phone(+84)" data-trigger="change" data-validation-minlength="10" data-type="number" data-required="true" data-error-message="Enter Your Telephone Number with length equal 10 " /><label for="telephone">Telephone</label>
                                                    </div>
                                                    <div>
                                                        <input type="text" name="address" value="" id="address-input" placeholder="Address" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter Your Address" /><label for="Address">Address</label>
                                                    </div>
                                                    <div>
                                                        <input type="text" name="email" value="" id="email" placeholder="Email" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter Your Email And It Have To right with format" /><label for="email">Email</label>
                                                    </div>
                                                    <div>
                                                        <input type="text" name="zip" value="" id="zip" placeholder="Zip Code" data-trigger="change" data-validation-minlength="1" data-type="text" data-error-message="Enter Your Zip Code" /><label for="zip">Zip Code</label>
                                                    </div>
                                                    <div>
                                                        <div class="country_options">
                                                            <div class="select">
                                                                <select id="country">
                                                                    <option value="1">VietNam</option>
                                                                    <option value="2">United Kingdom</option>
                                                                    <option value="3">United States</option>
                                                                    <option value="4">Etc.</option>
                                                                </select>
                                                            </div>
                                                            <label class="country" for="country">Country</label>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="check_same">
                                                        <input type="checkbox" />
                                                        <p style="font-size: 0.9rem; margin: 0;" for="same_as_shipping">Same As Shipping Address</p>
                                                    </div> -->
                                                </form>


                                        <?php
                                            }
                                        }
                                        ?>
                                        <p class="continue" onclick="handleClickStep1()">Continue</p>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="swiper-center">

                                <div class="column column2" id="col-2">
                                    <div class="step" id="step3">
                                        <div class="number">
                                            <span>2</span>
                                        </div>
                                        <div class="title">
                                            <h1>Shipping Information</h1>
                                        </div>
                                        <div class="modify">
                                            <i class="fa fa-plus-circle"></i>
                                        </div>
                                    </div>
                                    <div class="content" id="shipping">
                                        <form action="" method="" name="">
                                            <div class="ship_method">
                                                <input name="shipping" type="radio" id="shipping_1" value="1" />
                                                <label for="shipping_1"> Standard Shipping <span class="price">$4.00</span></label>
                                            </div>
                                            <div class="ship_method">
                                                <input name="shipping" type="radio" id="shipping_2" value="2" />
                                                <label for="shipping_2"> Express Shipping <span class="price">$8.00</span></label>
                                            </div>
                                            <div class="ship_method">
                                                <input name="shipping" type="radio" id="shipping_3" value="3" />
                                                <label for="shipping_3"> Overnight Shipping <span class="price">$12.00</span></label>
                                            </div>
                                        </form>
                                        <p class="continue" onclick="handleClickStep2()">Continue</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="swiper-center">

                                <div class="column column3" id="col-3">
                                    <div class="step" id="step4">
                                        <div class="number">
                                            <span>3</span>
                                        </div>
                                        <div class="title">
                                            <h1>Payment Information</h1>
                                        </div>
                                        <div class="modify">
                                            <i class="fa fa-plus-circle"></i>
                                        </div>
                                    </div>
                                    <div class="content" id="payment">
                                        <div class="left">
                                            <form class="go-right">
                                                <div>
                                                    <input type="text" name="card_number" value="" id="card_number" placeholder="xxxx-xxxx-xxxx-xxxx" data-trigger="change" data-validation-minlength="1" data-type="name" data-error-message="Enter Your Credit Card Number" /><label for="card_number">Card Number</label>
                                                </div>
                                                <div>
                                                    <div class="expiry">
                                                        <div class="month_select">
                                                            <select name="exp_month" value="" id="exp_month" placeholder="" data-trigger="change" data-type="name" data-error-message="Enter Your Credit Card Expiration Date">
                                                                <option value="1">01 (Jan)</option>
                                                                <option value="2">02 (Feb)</option>
                                                                <option value="3">03 (Mar)</option>
                                                                <option value="4">04 (Apr)</option>
                                                                <option value="5">05 (May)</option>
                                                                <option value="6">06 (Jun)</option>
                                                                <option value="7">07 (Jul)</option>
                                                                <option value="8">08 (Aug)</option>
                                                                <option value="9">09 (Sep)</option>
                                                                <option value="10">10 (Oct)</option>
                                                                <option value="11">11 (Nov)</option>
                                                                <option value="12">12 (Dec)</option>
                                                            </select>
                                                        </div>
                                                        <div class="year_select">
                                                            <select name="exp_year" value="" id="exp_year" placeholder="" data-trigger="change" data-type="name" data-error-message="Enter Your Credit Card Expiration Date">
                                                                <option value="1">14 </option>
                                                                <option value="2">15 (Feb)</option>
                                                                <option value="3">16 (Mar)</option>
                                                                <option value="4">17 (Apr)</option>
                                                                <option value="5">18 (May)</option>
                                                                <option value="6">19 (Jun)</option>
                                                                <option value="7">20 (Jul)</option>
                                                                <option value="8">22 (Aug)</option>
                                                                <option value="9">23 (Sep)</option>
                                                                <option value="10">24 (Oct)</option>
                                                                <option value="11">25 (Nov)</option>
                                                                <option value="12">26 (Dec)</option>
                                                            </select>
                                                        </div>
                                                        <label class="exp_date" for="Exp_Date">Exp Date</label>
                                                    </div>
                                                </div>
                                                <div class="sec_num">
                                                    <div>
                                                        <input type="text" name="ccv" value="" id="ccv" placeholder="123" data-trigger="change" data-validation-minlength="3" data-type="name" data-error-message="Enter Your Card Security Code" /><label for="ccv">Security Code</label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="right">
                                            <div class="accepted">
                                                <span><img src="https://i.imgur.com/Z5HVIOt.png"></span>
                                                <span><img src="https://i.imgur.com/Le0Vvgx.png"></span>
                                                <span><img src="https://i.imgur.com/D2eQTim.png"></span>
                                                <span><img src="https://i.imgur.com/Pu4e7AT.png"></span>
                                                <span><img src="https://i.imgur.com/ewMjaHv.png"></span>
                                                <span><img src="https://i.imgur.com/3LmmFFV.png"></span>
                                            </div>
                                        </div>
                                        <a href="#" disabled style="margin-top: 1rem;" class="continue" onclick="handleClickStep4()">Continue</a>
                                        <a href="placeAnOder.php" class="continue" onclick="handleClickStep3()">Or Payment in cash</a>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>



                <div class="check-info" id="check-fail">
                    <span>&times;</span> add review failed
                </div>

            </div>
        </div>
    </div>
</body>

<script>
    let col1 = document.getElementById("col-1")
    let col2 = document.getElementById("col-2")
    let col3 = document.getElementById("col-3")
    let step = [1, 2, 3]
</script>
<script>
    var swiper = new Swiper(".swiper-container", {
        pagination: {
            el: ".swiper-pagination",
            clickable: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        loop: false,
        speed: 700,
        allowTouchMove: false
    });

    var nextButton = document.querySelector(".swiper-button-next");
    var prevButton = document.querySelector(".swiper-button-prev");
    let checkFail = document.getElementById("check-fail")

    nextButton.style.display = "none";
    prevButton.style.display = "none";

    let shipInfo = {
        first_name:"",
        last_name:"",
        telephone:"",
        address:"",
        email:"",
        discount:"",
        country: "",
    }       

    const handleClickStep1 = () => {
        let first_name = document.getElementById("first_name").value
        let last_name = document.getElementById("last_name").value
        let telephone = document.getElementById("telephone").value
        let address = document.getElementById("address-input").value
        let email = document.getElementById("email").value
        let zip = document.getElementById("zip").value
        let selectElement = document.getElementById("country");
        if (validateForm()) {
            shipInfo = {
                first_name,
                last_name,
                telephone,
                address,
                email,
                discount: zip,
                country: selectElement.options[selectElement.selectedIndex].text,
            }
            console.log("Ship info1: ", shipInfo);
            swiper.slideNext();
        } else {
            checkFail.style.display = "block"
            checkFail.classList.add("hide")

            setTimeout(function() {
                checkFail.style.display = 'none';
                checkFail.classList.remove('hide');
            }, 3000);
            return
        }
    }

    const handleClickStep2 = () => {
        let shipMethod1 = document.getElementById("shipping_1")
        let shipMethod2 = document.getElementById("shipping_2")
        let shipMethod3 = document.getElementById("shipping_3")
        if (!shipMethod1.checked && !shipMethod2.checked && !shipMethod3.checked) {
            checkFail.innerHTML = "<span>&times;</span> You Must choose a method ship"
            checkFail.style.display = "block"
            checkFail.classList.add("hide")

            setTimeout(function() {
                checkFail.style.display = 'none';
                checkFail.classList.remove('hide');
            }, 3000);
            return
        } else {
            if(shipMethod1.checked) {
                shipInfo.shipMethod = "Standard Shipping ($6)"
                shipInfo.shipFee = 6
            }
            if(shipMethod2.checked) {
                shipInfo.shipMethod = "Express Shipping ($8)"
                shipInfo.shipFee = 8
            }
            if(shipMethod3.checked) {
                shipInfo.shipMethod = "Overnight Shipping ($12)"
                shipInfo.shipFee = 12
            }
            console.log("Ship info2: ", shipInfo);
            swiper.slideNext();
        }
    }

    const handleClickStep3 = () => {
        var expireDate = new Date();
        expireDate.setDate(expireDate.getDate() + 3);
        shipInfo.paymentMethod = "payment in cash" 
        localStorage.setItem("shipInfo", JSON.stringify(shipInfo));
        document.cookie = "shipInfo=" + JSON.stringify(shipInfo) + "; expires=" + expireDate.toUTCString() + "; path=/";
        console.log("Ship info3: ", shipInfo);
    }

    const handleClickStep4 = () => {
        checkFail.innerHTML = "<span>&times;</span> Payment With Bank Is Not Available"
        checkFail.style.display = "block"
        checkFail.classList.add("hide")

        setTimeout(function() {
            checkFail.style.display = 'none';
            checkFail.classList.remove('hide');
        }, 3000);
        return
    }

    function validateForm() {
        let inputs = document.querySelectorAll('input[data-required="true"]');
        let valid = true;

        for (let i = 0; i < inputs.length; i++) {
            let input = inputs[i];
            let error_message = input.getAttribute("data-error-message");
            let is_required = input.getAttribute("data-required") === "true";
            let type = input.getAttribute("data-type");
            let value = input.value.trim();

            if (is_required && value === "") {
                checkFail.innerHTML = `<span>&times;</span> ${error_message}`
                valid = false;
                break;
            }

            if (type === "name" && !/^[A-Za-zÀ-ỹ ]+$/.test(value)) {
                checkFail.innerHTML = `<span>&times;</span> ${error_message}`
                valid = false;
                break;
            }

            if (input.name === "email" && !/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(value)) {
                checkFail.innerHTML = `<span>&times;</span> ${error_message}`
                valid = false;
                break;
            }

            if (type === "number" && !/^\d+$/.test(value)) {
                checkFail.innerHTML = `<span>&times;</span> ${error_message}`
                valid = false;
                break;
            }

            if (input.name === "telephone" && !/^\d{10}$/.test(value)) {
                checkFail.innerHTML = `<span>&times;</span> ${error_message}`
                valid = false;
                break;
            }
        }
        return valid;
    }
</script>

</html>