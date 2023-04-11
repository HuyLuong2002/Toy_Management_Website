<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\classes\category.php";
include_once $filepath . "\lib\session.php";
$category = new Category();
Session::init();

//Set the default session name
$s_name = session_name();
$timeout = Session::get("timeout");
//Check the session exists or not
if (isset($_COOKIE[$s_name])) {
    setcookie($s_name, $_COOKIE[$s_name], time() + $timeout, "/");
} else {
    session_destroy();
}
?>
<header>
    <div class="section-header">
        <a href="index.php" class="home"> Toy Shop </a>

        <div class="nav-bar">
            <label class="icon"><i class="fa-solid fa-bars"></i></label>
            <ul class="menu-items">
                <li><a href="index.php" class="list-1">Home</a></li>
                <li><a href="about.php" class="list-1">About</a></li>
                <li><a href="orders.php" class="list-1">Orders</a></li>
                <li>
                    <a href="category.php?id=1&page=1" class="list-1">Category</a>
                    <i class="fa-solid fa-chevron-down"></i>
                    <ul class="sub-menu">
                        <?php
                        $show_category = $category->show_category();
                        if ($show_category) {
                            while ($result = $show_category->fetch_assoc()) { ?>
                                <li>
                                    <a href="category.php?id=<?php echo $result["id"]; ?>&page=1"> <?php echo $result["name"]; ?></a>
                                </li>
                        <?php }
                        }
                        ?>

                    </ul>
                </li>
                <li><a href="contact.php" class="list-1">Contact</a></li>
            </ul>
        </div>
        <div class="icons">
            <ul class="list-icon">
                <li>
                    <a onclick="handleSearch(event)" href="#">
                        <i class="search fa-solid fa-magnifying-glass fa-xl"></i>
                    </a>
                </li>
                <li>
                    <a href="favorites.php">
                        <i class="fa-solid fa-heart fa-xl"></i>
                        <span class="icon_status" id="favorite">(0)</span>
                    </a>
                </li>
                <li>
                    <a href="cart.php">
                        <i class="fa-solid fa-cart-shopping fa-xl"></i>
                        <span class="icon_status" id="cart">(0)</span>
                    </a>
                </li>
                <li onclick="menuToggle();">
                    <i class="fa-solid fa-user fa-xl"></i>
                    <div class="profile-menu">
                        <p>
                            <?php
                            if (Session::get("fullname") != null) {
                                echo "Hello" . " " . Session::get("fullname");
                            } else {
                                echo "Welcome";
                            }
                            ?>
                        </p>
                        <ul>
                            <li>
                                <i class="fa-solid fa-circle-user"></i>
                                <a href="profile.php?id=<?php echo Session::get("userID"); ?>" id="user-btn">My Profile</a>
                            </li>
                            <li>
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <?php
                                if (Session::get("user") == false) {
                                ?>
                                    <a href="login.php">Login</a>
                                <?php
                                } else {

                                ?>
                                    <a href="login.php?action=logout">Log out</a>
                                <?php
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Nhập sản phẩm muốn tìm kiếm vào đây">
    </div>
</header>
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script>
    $(document).ready(function() {
        $('.sub-menu').parent('li').addClass('has-child');
    });
</script>

<script>
    const listMenuNav = document.querySelectorAll('.list-1');
    let url = location.pathname.split("/")
    for (let i = 0; i < listMenuNav.length; i++) {
        var pathname = listMenuNav[i].getAttribute('href').split("?");
        if (pathname[0] === url[1]) {
            listMenuNav[i].classList.add('active');
            break;
        }
    }
</script>

<script>
    let search = document.getElementsByClassName('search')[0];
    let searchBar = document.getElementsByClassName('search-bar')[0];

    const handleSearch = (event) => {
        event.preventDefault();
        search.classList.toggle('fa-times');
        search.classList.toggle('fa-magnifying-glass');
        searchBar.classList.toggle("active");

    }
</script>

<script>
    function menuToggle() {
        const toggle = document.querySelector('.profile-menu');
        toggle.classList.toggle('active');
    }

    let CartAdd = JSON.parse(localStorage.getItem('cartAdd'));
    let Cart = document.getElementById("cart").innerText = `(${CartAdd.length})`;

    let FavoriteAdd = JSON.parse(localStorage.getItem('favorite'));
    let Favorite = document.getElementById("favorite").innerText = `(${FavoriteAdd.length})`;
</script>