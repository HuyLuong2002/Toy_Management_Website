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
                <a href="login.php">
                    <div id="user-btn" class="fa-solid fa-user fa-xl"></div>
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