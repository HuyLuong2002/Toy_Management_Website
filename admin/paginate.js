let AdminSidebar = document.getElementById("wrap-admin-side")
let listBar = [
  {
    id: 1,
    title: "DashBoard",
    href: "index.php",
    icon: "la-igloo"
  },
  {
    id: 2,
    title: "Customers",
    href: "customers.php?id=2",
    icon: "la-users"
  },
  {
    id: 3,
    title: "Products",
    href: "products.php?id=3",
    icon: "la-robot"
  },
  {
    id: 4,
    title: "Orders",
    href: "id=orders",
    icon: "la-shopping-cart"
  },
  {
    id: 5,
    title: "Inventory",
    href: "id=inventory",
    icon: "la-box"
  },
  {
    id: 6,
    title: "Accounts",
    href: "id=accounts",
    icon: "la-user-circle"
  },
  {
    id: 7,
    title: "Permission",
    href: "id=permission",
    icon: "la-user-check"
  },
  {
    id: 8,
    title: "Provider",
    href: "id=provider",
    icon: "la-cart-arrow-down"
  },
  {
    id: 9,
    title: "Sale",
    href: "id=sale",
    icon: "la-percent"
  },
  {
    id: 10,
    title: "Favorite",
    href: "id=favorite",
    icon: "la-heart"
  },
];

const handleActiveBg = () => {
    const listBartMapped = listBar.map((item) => {
        return `<li onclick="handleActive(event, ${item.id})">
                    <a href="${item.href}" class="item" id="check-${item.id}">
                        <span class="las ${item.icon}"> </span>
                        <span> ${item.title} </span>
                    </a>
                </li>`;
    });

    AdminSidebar.innerHTML = listBartMapped
};

const handleActive = ( event, id ) => {
    // event.preventDefault();
    listBar.forEach(item => {
        let a = document.getElementById("check-"+item.id)
        a.classList.remove("active");
    })

    let b = document.getElementById("check-"+id)
    b.classList.add("active");
}


handleActiveBg()
let firstActive = document.getElementById("check-1")
firstActive.classList.add("active");

