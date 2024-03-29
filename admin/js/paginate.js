let AdminSidebar = document.getElementById("wrap-admin-side");
// let currentUserAPI =
  // "http://localhost:8000/Toy_Management_Website/api/accounts/currentUser.php";
// let currentUserAPI = "http://localhost:8080/Toy_Management_Website/api/accounts/currentUser.php"
let currentUserAPI = "http://localhost:3000/api/accounts/currentUser.php"
const fetchAPI = async (api) => {
  return await fetch(api)
    .then((response) => response.json())
    .then((data) => data)
    .catch((error) => console.error(error));
};

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
    icon: "la-cube",
  },
  {
    id: 3,
    title: "Orders",
    href: "index.php?id=3&page=1",
    icon: "la-shopping-cart",
  },
  {
    id: 4,
    title: "Inventory",
    href: "index.php?id=4&page=1",
    icon: "la-box",
  },
  {
    id: 5,
    title: "Accounts",
    href: "index.php?id=5&page=1",
    icon: "la-user-circle",
  },
  {
    id: 6,
    title: "Permission",
    href: "index.php?id=6&page=1",
    icon: "la-user-check",
  },
  {
    id: 7,
    title: "Providers",
    href: "index.php?id=7&page=1",
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
    icon: "la-gift",
  },
];

const url = window.location.href;
const match = url.match(/id=([^&]*)/);
const idPage = match ? match[1] : null;

const handleActiveBg = (arr = listBar) => {
  const listBartMapped = arr
    .map((item) => {
      return `<li onclick="handleActive(${item.id})">
                    <a href="${item.href}" class="item" id="check-${item.id}">
                        <span class="las ${item.icon}"> </span>
                        <span> ${item.title} </span>
                    </a>
                    ${
                      item.child
                        ? `<ul class="item-child hide" id="item-child">
                      ${item.child
                        .map(
                          (itemChild) => `<li onclick="handleOpenForm()">
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
};

const handleOpenItemChild = () => {
  let itemChild = document.getElementById("item-child");
  itemChild.classList.toggle("hide");
};

const handleActive = (id) => {
  listBar.forEach((item) => {
    let a = document.getElementById("check-" + item.id);
    a.classList.remove("active");
  });

  let b = document.getElementById("check-" + id);
  b.classList.add("active");
};

const ActiveBar = (arr) => {
  arr.forEach((item) => {
    if (item.id == Number(idPage)) {
      let b = document.getElementById("check-" + item.id);
      b.classList.add("active");
      if (item.child) handleOpenItemChild();
    } else {
      let c = document.getElementById("check-" + item.id);
      c.classList.remove("active");
    }
  });
};

const middleWare = async () => {
  const getCurrentUser = await fetchAPI(currentUserAPI);
  if (getCurrentUser) {
    const { permission_id } = getCurrentUser;
    let listBarCopy = [...listBar];

    if (permission_id == 1) {
      const excludedIds = [1, 2, 3, 4, 7, 8, 9, 10];
      listBarCopy = listBarCopy.filter(
        (item) => !excludedIds.includes(item.id)
      );
    }

    if (permission_id == 3) {
      listBarCopy = [...listBar];
      
    }

    if (permission_id == 4) {
      const excludedIds = [1, 5, 6, 9];
      listBarCopy = listBarCopy.filter(
        (item) => !excludedIds.includes(item.id)
      );
    }

    handleActiveBg(listBarCopy);
    const firstActive = document.getElementById(`check-${idPage}`);
    firstActive.classList.add("active");
    ActiveBar(listBarCopy);
  }
};

middleWare();

// 1 là admin
// 2 là khách hàng
// 3 là quản lý : Quản lý thì dc xem hết
// 4 là nhân viên: account bỏ, Permission bỏ, Thống kê bên chart bỏ, Dashboard bỏ
