<header>
    <div class="section-header">
        <a href="index.php" class="home"> Toy Shop </a>

        <div class="nav-bar">
            <label class="icon"><i class="fa-solid fa-bars"></i></label>
            <ul class="menu-items">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li>
                    <a href="category.php">Category</a>
                    <i class="fa-solid fa-chevron-down"></i>
                    <ul class="sub-menu">
                        <li>
                            <a href="category.php">Smart Toys</a>
                        </li>
                        <li>
                            <a href="category.php">Robot</a>
                        </li>
                        <li>
                            <a href="category.php">LEGO</a>
                        </li>
                        <li>
                            <a href="category.php">Barie doll</a>
                        </li>

                    </ul>
                </li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>

        <div class="icons">
            <div>
                <a onclick="handleSearch(event)" href="#">
                    <i class="search fa-solid fa-magnifying-glass fa-xl"></i>
                </a>
            </div>
            <div>
                <a href="favorites.php">
                    <i class="fa-solid fa-heart fa-xl"></i>
                    <span class="icon_status">(0)</span>
                </a>
            </div>
            <div>
                <a href="cart.php">
                    <i class="fa-solid fa-cart-shopping fa-xl"></i>
                    <span class="icon_status">(0)</span>
                </a>
            </div>
            <div>
                <a href="profile.php" id="user-btn">
                    <div class="fa-solid fa-user fa-xl"></div>
                    <div class="profile">
                        <h2 class="profile-name">Hi, loz</h2>
                        <button class="profile-update">update profile</button>
                        <button class="profile-log">log out</button>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Nhập sản phẩm muốn tìm kiếm vào đây">
    </div>
</header>

<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script>
    $(document).ready(function(){
        $('.sub-menu').parent('li').addClass('has-child');
    });
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