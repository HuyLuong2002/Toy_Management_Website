let orderSession = document.getElementById("orders")
let bodyOrder = document.getElementById("body_orders")
let infoDetail = document.getElementById("ship-info-order");
let productDetailOrder = document.getElementById("wrap-load-order-product");
let currentUserAPI = "http://localhost:8000/Toy_Management_Website/api/accounts/currentUser.php" 
// let currentUserAPI = "http://localhost:8080/Toy_Management_Website/api/accounts/currentUser.php" 
// let currentUserAPI = "http://localhost:3000/api/accounts/currentUser.php" 
let modal = document.getElementById("modal")

const fetchAPI = async (api) => {
    return await fetch(api)
        .then((response) => response.json())
        .then((data) => data)
        .catch((error) => console.error(error));
};

let OrderListProductDetail = []

const handleShowListOrder = async () => {
    let getCurrentUser = await fetchAPI(currentUserAPI)

    const orderApi = `http://localhost:8000/Toy_Management_Website/api/orders/show_user.php?userID=${getCurrentUser.id}`;
    // const orderApi = `http://localhost:3000/api/orders/show_user.php?userID=${Order.user_id}`;
    // const orderApi = `http://localhost:8080/Toy_Management_Website/api/orders/show_user.php?userID=${getCurrentUser.id}`;


    let orderList = await fetchAPI(orderApi)
    if (!orderList) {
        orderSession.innerHTML = "<h1>Not found Order!</h1>"
        return;
    }

    let listOrderOfUser = orderList.orders.map((item, index) => {
        OrderListProductDetail.push([item.id, item.order_list])

        let statusText = "PENDING"
        if (item.order_list.status === 1) {
            statusText = "DELIVERING"
        }
        if (item.order_list.status === 0) {
            statusText = "SHIPPED"
        }
        return `
            <tr key=${index}>
                <td>${item.id}</td>
                <td>${getCurrentUser.firstname} ${getCurrentUser.lastname}</td>
                <td>${item.order_list.address}</td>
                <td>${item.order_list.phone}</td>
                <td>${item.order_list.email}</td>
                <td>${item.order_list.pay_method}</td>
                <td class=${"status-" + item.order_list.status}>${statusText}</td>
                <td>$${item.order_list.total_price}</td>
                <td><a href="#" onclick="handleShowDetailOrder(${item.id})">Detail</a></td>
            </tr>
        `;
    }).join('')

    bodyOrder.innerHTML = listOrderOfUser
}

let handleShowDetailOrder = async (idOrder) => {
    let getCurrentUser = await fetchAPI(currentUserAPI)
    if (!OrderListProductDetail) {
        infoDetail.innerHTML = "<h1>Not found Order!</h1>";
        return;
    }

    let newOrder = OrderListProductDetail.find(item => item[0] === idOrder)

    const listOrder = `
                <p style="font-size: 1.5rem;">Billing: </p>
                <div class="wrap-order-container">
                    <div class="wrap-order-info">
                        <p>Name: <span>${getCurrentUser.firstname} ${getCurrentUser.lastname}</span></p>
                        <p>Email: <span>${newOrder[1].email}</span></p>
                        <p>Phone: <span>${newOrder[1].phone}</span></p>
                        <p>Address: <span>${newOrder[1].address}</span></p>
                        <p>Country: <span>${newOrder[1].country}</span></p>
                    </div>
                    <div class="wrap-order-info">
                        <p>VAT(10%): <span>$${newOrder[1].vat}</span></p>
                        <p>Ship Method: <span>${newOrder[1].ship_method}</span></p>
                        <p>Payment Method: <span>${newOrder[1].pay_method}</span></p>
                        <p>Total Price: <span>$${newOrder[1].total_price}</span></p>
                        <p>Date placed order: <span>${newOrder[1].date}</span></p>
                    </div>
                </div>
               
            `;

    infoDetail.innerHTML = listOrder
    loadProduct(idOrder)
    modal.style.display = "flex"
};

const loadProduct = async (idOrder) => {
    let Product = await fetchAPI(`http://localhost:8000/Toy_Management_Website/api/detail_orders/show_order.php?orderID=${idOrder}`)
    // let Product = await fetchAPI(`http://localhost:8080/Toy_Management_Website/api/detail_orders/show_order.php?orderID=${idOrder}`)
    // let Product = `http://localhost:3000/api/detail_orders/show_order.php?orderID=${idOrder}`;

    if (!Product) {
        productDetailOrder.innerHTML = "<h1>Not found Order!</h1>"
        return;
    }

    let listProduct = Product.detail_orders.map((item) => {
        let total = item.detail_order_list.price * item.detail_order_list.quantity
        return `
            <tr key=${item.id}>
                <td><img src=${'admin/uploads/' + item.detail_order_list.image} alt=""></td>
                <td>${item.detail_order_list.name}</td>
                <td>$${item.detail_order_list.price}</td>
                <td>${item.detail_order_list.quantity}</td>
                <td>$${total}</td>
            </tr>
        `;
    }).join('')

    productDetailOrder.innerHTML = listProduct
}

const handleClose = () => {
    modal.style.display = "none";
};

window.onclick = (e) => {
    if(e.target == modal) 
        handleClose()
}



handleShowListOrder()
