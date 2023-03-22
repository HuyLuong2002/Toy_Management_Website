<header>
    <div class="section-header">
        <a href="index.php" class="home"> Toy Shop </a>

        <div class="nav-bar">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="orders.php">Orders</a>
            <a href="category.php">Category</a>
            <a href="contact.php">Contact</a>
        </div>

        <div class="icons">
            <div>
                <a onclick="handleSearch(event)" href="#">
                    <i class="search fa-solid fa-magnifying-glass fa-xl"></i>
                </a>
            </div>
            <div>
                <a href="">
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
<<<<<<< HEAD
                <a href="" id="user-btn">
                    <div class="fa-solid fa-user fa-xl"></div>    
                    <div class="profile">
                        <h2 class="profile-name">Hi, loz</h2>
                        <button class="profile-update">update profile</button>
                        <button class="profile-log">log out</button>
                    </div>
=======
                <a href="login.php">
                    <div id="user-btn" class="fa-solid fa-user fa-xl"></div>
>>>>>>> df87ded3f80698773838859d31819cf81d2bf79d
                </a>
            </div>
        </div>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Nhập sản phẩm muốn tìm kiếm vào đây">
    </div>
</header>


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