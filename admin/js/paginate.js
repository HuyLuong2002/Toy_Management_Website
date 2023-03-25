let AdminSidebar = document.getElementById("wrap-admin-side")
let listBar = [
  {
    id: 1,
    title: "Dashboard",
    href: "index.php",
    icon: "la-igloo"
  },
  {
    id: 2,
    title: "Products",
    href: "products.php?id=2",
    icon: "la-users"
  },
  {
    id: 3,
    title: "Orders",
    href: "orders.php?id=3",
    icon: "la-shopping-cart"
  },
  {
    id: 4,
    title: "Inventory",
    href: "inventory.php?id=4",
    icon: "la-box"
  },
  {
    id: 5,
    title: "Accounts",
    href: "accounts.php?id=5",
    icon: "la-user-circle"
  },
  {
    id: 6,
    title: "Permission",
    href: "permission.php?id=6",
    icon: "la-user-check"
  },
  {
    id: 7,
    title: "Providers",
    href: "providers.php?id=7",
    icon: "la-cart-arrow-down"
  },
  {
    id: 8,
    title: "Sale",
    href: "sale.php?id=8",
    icon: "la-percent"
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

