let AdminSidebar = document.getElementById("wrap-admin-side")
let listBar = [
  {
    id: 1,
    title: "DashBoard",
    href: "#",
    icon: "la-igloo"
  },
  {
    id: 2,
    title: "Customers",
    href: "#",
    icon: "la-users"
  },
  {
    id: 3,
    title: "Project",
    href: "#",
    icon: "la-clipboard-list"
  },
  {
    id: 4,
    title: "Orders",
    href: "#",
    icon: "la-shopping-cart"
  },
  {
    id: 5,
    title: "Inventory",
    href: "#",
    icon: "la-receipt"
  },
  {
    id: 6,
    title: "Accounts",
    href: "#",
    icon: "la-user-circle"
  },
  {
    id: 7,
    title: "Tasks",
    href: "#",
    icon: "la-clipboard-list"
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
    event.preventDefault();
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

