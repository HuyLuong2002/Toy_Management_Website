let AdminSidebar = document.getElementById("wrap-admin-side");
let listBar = [
  {
    id: 1,
    title: "Dashboard",
    href: "index.php?id=1",
    icon: "la-igloo",
  },
  {
    id: 2,
    title: "Products",
    href: "index.php?id=2&page=1",
    icon: "la-users"
  },
  {
    id: 3,
    title: "Orders",
    href: "index.php?id=3",
    icon: "la-shopping-cart"
  },
  {
    id: 4,
    title: "Inventory",
    href: "index.php?id=4",
    icon: "la-box",
  },
  {
    id: 5,
    title: "Accounts",
    href: "index.php?id=5",
    icon: "la-user-circle",
  },
  {
    id: 6,
    title: "Permission",
    href: "index.php?id=6",
    icon: "la-user-check",
  },
  {
    id: 7,
    title: "Providers",
    href: "index.php?id=7",
    icon: "la-cart-arrow-down",
  },
  {
    id: 8,
    title: "Sale",
    href: "index.php?id=8&page=1",
    icon: "la-percent",
  },
  {
    id: 9,
    title: "Chart",
    href: "index.php?id=9",
    icon: "la-chart-bar",
  },
  {
    id: 10,
    title: "Category",
    href: "index.php?id=10",
    icon: "la-chart-bar",
  },
];

const url = window.location.href;
const match = url.match(/id=([^&]*)/);
const idPage = match ? match[1] : null;

const handleActiveBg = () => {
  const listBartMapped = listBar
    .map((item) => {
      return `<li onclick="handleActive(event, ${item.id})">
                    <a href="${item.href}" class="item" id="check-${item.id}">
                        <span class="las ${item.icon}"> </span>
                        <span> ${item.title} </span>
                    </a>
                    ${
                      item.child
                        ? `<ul class="item-child hide" id="item-child">
                      ${item.child
                        .map(
                          (
                            itemChild
                          ) => `<li onclick="handleOpenForm()">
                                <a href="${itemChild.href}" class="item" id="check-${itemChild.id}">
                                    <span class="las ${itemChild.icon}"> </span>
                                    <span> ${itemChild.title} </span>
                                </a>
                            </li>`
                        )
                        .join("")}
                    </ul>`
                        : ""
                    }
                </li>
                
                `;
    })
    .join("");

  AdminSidebar.innerHTML = listBartMapped;
};

const handleOpenForm = () => {
  // event.preventDefault();
}

const handleOpenItemChild = () => {
  let itemChild = document.getElementById("item-child");
  itemChild.classList.toggle("hide");
};

const handleActive = (event, id) => {
  // event.preventDefault();
  listBar.forEach((item) => {
    let a = document.getElementById("check-" + item.id);
    a.classList.remove("active");
  });

  let b = document.getElementById("check-" + id);
  b.classList.add("active");
};

const ActiveBar = () => {
  listBar.forEach((item) => {
    if (item.id === Number(idPage)) {
      let b = document.getElementById("check-" + item.id);
      b.classList.add("active");
      if (item.child) handleOpenItemChild();
    } else {
      let c = document.getElementById("check-" + item.id);
      c.classList.remove("active");
    }
  });
};

handleActiveBg();
let firstActive = document.getElementById("check-1");
firstActive.classList.add("active");
ActiveBar();
