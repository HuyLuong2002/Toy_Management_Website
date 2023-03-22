
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
    <link rel="stylesheet" href="./assets/css/contact.css">
</head>
<body>
<?php include_once "./components/header.php"; ?>
    <div class="contact-container">
        <form onsubmit="">
            <h3>GET IN TOUCH</h3>
            <input type="text" id="name" placeholder="Your Name" required>
            <input type="email" id="email" placeholder="Email" required>
            <input type="text" id="phone" placeholder="Phone Number" required>
            <textarea name="" id="message" cols="" rows="4" placeholder="How can we help you">

            </textarea>
            <button type="submit">Send</button>
        </form>
    </div>
<?php include "./components/footer.php"; ?>

</body>

