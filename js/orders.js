let orderSession = document.getElementById("orders")
let bodyOrder = document.getElementById("body_orders")
let infoDetail = document.getElementById("ship-info-order");
let productDetailOrder = document.getElementById("wrap-load-order-product");


let Order = JSON.parse(localStorage.getItem('Order'));

const orderApi = `http://localhost:8000/Toy_Management_Website/api/orders/show_user.php?userID=${Order.user_id}`;


const fetchAPI = async (api) => {
    return await fetch(api)
        .then((response) => response.json())
        .then((data) => data)
        .catch((error) => console.error(error));
};

let OrderListProductDetail = []

const handleShowListOrder = async () => {
    let orderList = await fetchAPI(orderApi)
    if(!orderList) {
        orderSession.innerHTML = "<h1>Not found Order!</h1>"
        return;
    }

    let listOrderOfUser = orderList.orders.map((item, index) => {
        OrderListProductDetail.push([item.id, item.order_list])
        return `
            <tr key=${index}>
                <td>${item.id}</td>
                <td>${Order.last_name} ${Order.first_name}</td>
                <td>${item.order_list.address}</td>
                <td>${item.order_list.phone}</td>
                <td>${item.order_list.email}</td>
                <td>${item.order_list.pay_method}</td>
                <td class="status-2">PENDING</td>
                <td>$${item.order_list.total_price}</td>
                <td><a href="#" onclick="handleShowDetailOrder(${item.id})">Detail</a></td>
            </tr>
        `;
    }).join('')

    bodyOrder.innerHTML = listOrderOfUser
}

let handleShowDetailOrder = (idOrder) => {
    // let Vat = orderList.total_price

    if (!OrderListProductDetail) {
        infoDetail.innerHTML = "<h1>Not found Order!</h1>";
        return;
    }

    let newOrder = OrderListProductDetail.find(item => item[0] === idOrder)

    const listOrder = `
                <p style="font-size: 1.5rem;">Billing: </p>
                <div class="wrap-order-container">
                    <div class="wrap-order-info">
                        <p>Name: <span>${Order.last_name} ${Order.first_name}</span></p>
                        <p>Email: <span>${newOrder[1].email}</span></p>
                        <p>Phone: <span>${newOrder[1].phone}</span></p>
                        <p>Address: <span>${newOrder[1].address}</span></p>
                        <p>Country: <span>${newOrder[1].country}</span></p>
                    </div>
                    <div class="wrap-order-info">
                        <p>VAT(10%): <span>$300</span></p>
                        <p>Ship Method: <span>Express $12</span></p>
                        <p>Payment Method: <span>${newOrder[1].pay_method}</span></p>
                        <p style="font-size: 2rem;">Total Price: <span>$${newOrder[1].total_price}</span></p>
                    </div>
                </div>
               
            `;

    infoDetail.innerHTML = listOrder
    loadProduct()
    modal.style.display = "flex"
};

const loadProduct = () => {
    if(!Order) {
        productDetailOrder.innerHTML = "<h1>Not found Order!</h1>"
        return;
    }

    let listProduct = Order.product.map((item) => {
        let total = item.price * item.quantity
        return `
            <div class="order-product" key=${item.id}>
                <img src=${item.image} alt="">
                <p class="product_name">${item.name}</p>
                <p class="product_price">$${item.price}</p>
                <P class="product_quantity">${item.quantity}</P>
                <P class="product_total">$${total}</P>
            </div>
        `;
    }).join('')

    productDetailOrder.innerHTML = listProduct
}

const handleClose = () => {
    modal.style.display = "none";
};

handleShowListOrder()

// Thêm vat, userid, product, ship method