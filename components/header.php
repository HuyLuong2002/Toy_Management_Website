<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/categoryController.php";
include_once $filepath . "/lib/session.php";
$categoryController = new CategoryController();

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

<style>
    .wrap-search-top {
        display: flex;
        width: 100%;
        background-color: #fff;
    }

    .wrap-key-search {
        display: flex;
        flex: 1;
    }

    .wrap-key-search a {
        display: flex;
        align-items: center;
        text-decoration: none;
        padding: 1rem;
        border-right: 1px solid #ccc;
    }

    .key-search {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 0.25rem 1rem;
    }

    .key-search>.key-child {
        display: block;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: rgba(0, 0, 0, 0.25);
        color: #0f0f0f;
        cursor: pointer;
        transition: all ease 0.2s;
    }

    .key-search>.key-child:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }



    @media screen and (max-width: 650px) {
        .wrap-search-top {
            flex-direction: column;
        }

        .wrap-key-search a {
            padding: 0.5rem;
        }
    }
</style>
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
                    <a href="category.php?id=1" class="list-1">Category</a>
                    <i class="fa-solid fa-chevron-down"></i>
                    <ul class="sub-menu">
                        <?php
                        $show_category = $categoryController->show_category();
                        if ($show_category) {
                            while ($result = $show_category->fetch_assoc()) { ?>
                                <li>
                                    <a href="category.php?id=<?php echo $result["id"]; ?>"><?php echo $result["name"]; ?></a>
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
                            <?php if (Session::get("fullname") != null) {
                                echo "Hello" . " " . Session::get("fullname");
                            } else {
                                echo "Welcome";
                            } ?>
                        </p>
                        <ul>
                            <li>
                                <i class="fa-solid fa-circle-user"></i>
                                <a href="profile.php?id=<?php echo Session::get(
                                                            "userID"
                                                        ); ?>" id="user-btn">My Profile</a>
                            </li>
                            <li>
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <?php if (Session::get("user") == false) { ?>
                                    <a href="login.php">Login</a>
                                <?php } else { ?>
                                    <a href="../login.php?action=logout">Log out</a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="search-bar">
        <div class="wrap-search-top">
            <div class="wrap-key-search">
                <input type="text" placeholder="Nhập sản phẩm muốn tìm kiếm vào đây" id="searchuser">
                <a onclick="" href="#">
                    <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                </a>
            </div>
            <div class="key-search" id="key-search">

            </div>

            <div class="key-search-list-price hide-list" id="key-search-list-price">
                <div class="clip-path-key-search-price">
                </div>

                <ul class="key-search-list-price-child" id="key-search-list-price-id">
                    <li onclick="ActiveBgListPrice(21)" id="21" class="bg-list">< 500</li>
                    <li onclick="ActiveBgListPrice(22)" id="22">500 -> 1000</li>
                    <li onclick="ActiveBgListPrice(23)" id="23">1000 -> 2000</li>
                    <li onclick="ActiveBgListPrice(24)" id="24">> 2000</li>
                </ul>
            </div>

            <div class="key-search-list-star hide-list" id="key-search-list-star">
                <div class="clip-path-key-search-star">
                </div>
                <ul class="key-search-list-star-child" id="key-search-list-star-id">
                    <li onclick="ActiveBgListStar(31)" id="31" class="bg-list">&#9733; </li>
                    <li onclick="ActiveBgListStar(32)" id="32">&#9733;&#9733;</li>
                    <li onclick="ActiveBgListStar(33)" id="33">&#9733;&#9733;&#9733;</li>
                    <li onclick="ActiveBgListStar(34)" id="34">&#9733;&#9733;&#9733;&#9733;</li>
                    <li onclick="ActiveBgListStar(35)" id="35">&#9733;&#9733;&#9733;&#9733;&#9733;</li>
                </ul>
            </div>
        </div>
        <div class="wrap-product-search" id="searchresultproductuser">

        </div>
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
    let typeKeySearch = [{
            id: 0,
            title: "All",
            active: true
        },
        {
            id: 1,
            title: "Category",
            active: false
        },
        {
            id: 2,
            title: "Price",
            active: false

        },
        {
            id: 3,
            title: "Name",
            active: false
        },
        {
            id: 4,
            title: "Rating",
            active: false
        },
    ]

    function menuToggle() {
        const toggle = document.querySelector('.profile-menu');
        toggle.classList.toggle('active');
    }

    let CartAdd = JSON.parse(localStorage.getItem('cartAdd'));
    let FavoriteAdd = JSON.parse(localStorage.getItem('favorite'));
    
    if(!CartAdd) {
        document.getElementById("cart").innerText = "(0)"
    } else {
        document.getElementById("cart").innerText = `(${CartAdd.length})`;
    }
    if(!FavoriteAdd) { 
        document.getElementById("favorite").innerText = "(0)"
    } else {
        document.getElementById("favorite").innerText = `(${FavoriteAdd.length})`;
    }

    // let Cart = document.getElementById("cart").innerText = `(${CartAdd?.length})`;
    // let Favorite = document.getElementById("favorite").innerText = `(${FavoriteAdd?.length})`;

    

    const loadKeySearch = (arr = typeKeySearch) => {
        let keySearch = document.getElementById("key-search")
        let keyChildList = arr.map((item, i) => {
            return `<span class="${item.active ? "key-child active-bg-keychild" : "key-child"}" id=${item.id} key=${i} onclick="handleActiveKey(${item.id})">${item.title}</span>`
        }).join("")

        keySearch.innerHTML = keyChildList
    }

    const handleActiveKey = (id) => {
        const listPrice = document.getElementById("key-search-list-price")
        const listStar = document.getElementById("key-search-list-star")

        typeKeySearch.forEach(item => {
            let keyTag = document.getElementById(item.id)
            if (keyTag.classList.contains("active-bg-keychild")) {
                keyTag.classList.remove("active-bg-keychild")
            }
        });

        typeKeySearch.forEach(item => {
            if (item.id === id) {
                let keyTag = document.getElementById(item.id)
                keyTag.classList.add('active-bg-keychild')
            }
        })

        if(id === 2) {
            listPrice.classList.toggle("hide-list")
        } else {
            listPrice.classList.add("hide-list")
        }

        if(id === 4) {
            listStar.classList.toggle("hide-list")
        } else {
            listStar.classList.add("hide-list")
        }
    }

    const ActiveBgListPrice = (num) => {
        let list = document.getElementById(`${num}`)
        list.classList.add("bg-list")

        for(var i = 21; i <= 24; i++) {
            if(i !== num) {
                let listRemove = document.getElementById(`${i}`)
                if(listRemove.classList.contains("bg-list"))
                    listRemove.classList.remove("bg-list")
            }
        }
    }

    const ActiveBgListStar = (num) => {
        let list = document.getElementById(`${num}`)
        list.classList.add("bg-list")

        for(var i = 31; i <= 35; i++) {
            if(i !== num) {
                let listRemove = document.getElementById(`${i}`)
                if(listRemove.classList.contains("bg-list"))
                    listRemove.classList.remove("bg-list")
            }
        }
    }

    loadKeySearch(typeKeySearch)
</script>

<script src="../js/validate_input.js"></script>
<!-- coding live search function -->
<script type="text/javascript">
    $(document).ready(function() {
        var searchkey = 0;
        $("#searchuser").keyup(function() {
            var input = $(this).val();
            if (checkSearchInput(input) == false) {
                $("#searchresultproductuser").html("<span class='error'>Input Value Not Valid</span>");
                $("#searchresultproductuser").css("display", "block");
                return;
            } else {
                $("#searchresultproductuser").css("display", "none");
            }
            if (input != "") {
                $.ajax({
                    url: "../controller/headerController.php",
                    method: "POST",
                    data: {
                        input: input,
                        searchkey: searchkey,
                    },
                    success: function(data) {
                        $("#searchresultproductuser").html(data);
                        $("#searchresultproductuser").css("display", "block");
                    }
                });
            } else {
                $("#searchresultproductuser").css("display", "block");
            }
        });

        $('#key-search-list-price-id').bind('click', function(event) {
            searchkey = $(event.target).attr('id');
            
            $.ajax({
                url: "../controller/headerController.php",
                method: "POST",
                data: {
                    searchkey: searchkey,
                },
                success: function(data) {
                    $("#searchresultproductuser").html(data);
                    $("#searchresultproductuser").css("display", "block");
                }
            });
        });

        $("#key-search span").click(function() {
            searchkey = $(this).attr('id');
            console.log(searchkey);
        });
    });
</script>