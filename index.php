<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="./assets/css/home.css" />
    <link rel="stylesheet" href="./assets/css/slide.css" />
    <!-- font awesome cdn link  -->
    <script
      src="https://kit.fontawesome.com/1b6e53cabd.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <header>
      <div class="section-header">
        <a href="index.php" class="home"> Toy Shop </a>

        <div class="nav-bar">
          <a href="index.php">Home</a>
          <a href="">About</a>
          <a href="">Orders</a>
          <a href="">Shop</a>
          <a href="">Contact</a>
        </div>
  
        <div class="icons">
          <a href="">
            <i class="fa-solid fa-magnifying-glass fa-xl"></i>
          </a>
          <a href="">
            <i class="fa-solid fa-heart fa-xl"></i>
            <span class="icon_status">(0)</span>
          </a>
          <a href="">
            <i class="fa-solid fa-cart-shopping fa-xl"></i>
            <span class="icon_status">(0)</span>
          </a>
          <a href="">
            <div id="user-btn" class="fa-solid fa-user fa-xl"></div>
          </a>
        </div>
      </div>
    </header>

    <div class="slide-container">
      <div class="w3-content w3-display-container" style="max-width: 600px">
        <img class="mySlides" src="./assets/images/home-img-1.png" style="width: 80%" />
        <img class="mySlides" src="./assets/images/home-img-2.png" style="width: 80%" />
        <img class="mySlides" src="./assets/images/home-img-3.png" style="width: 80%" />
        <div
          class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle"
          style="width: 100%"
        >
          <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">
            &#10094;
          </div>
          <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">
            &#10095;
          </div>
          <span
            class="w3-badge demo w3-border w3-transparent w3-hover-white"
            onclick="currentDiv(1)"
          ></span>
          <span
            class="w3-badge demo w3-border w3-transparent w3-hover-white"
            onclick="currentDiv(2)"
          ></span>
          <span
            class="w3-badge demo w3-border w3-transparent w3-hover-white"
            onclick="currentDiv(3)"
          ></span>
        </div>
      </div>
    </div>
    <script src="./js/home.js"></script>
  </body>

</html>
