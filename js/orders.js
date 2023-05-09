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
                <td class=${"status-"+item.order_list.status}>PENDING</td>
                <td>$${item.order_list.total_price}</td>
                <td><a href="#" onclick="handleShowDetailOrder(${item.id})">Detail</a></td>
            </tr>
        `;
    }).join('')

    bodyOrder.innerHTML = listOrderOfUser
}

let handleShowDetailOrder = (idOrder) => {


    console.log("cc: ", OrderListProductDetail);
    
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
                        <p>VAT(10%): <span>$${newOrder[1].vat}</span></p>
                        <p>Ship Method: <span>${newOrder[1].ship_method}</span></p>
                        <p>Payment Method: <span>${newOrder[1].pay_method}</span></p>
                        <p style="font-size: 2rem;">Total Price: <span>$${newOrder[1].total_price}</span></p>
                    </div>
                </div>
               
            `;

    infoDetail.innerHTML = listOrder
    loadProduct(idOrder)
    modal.style.display = "flex"
};

const loadProduct = async (idOrder) => {
    let Product = await fetchAPI(`http://localhost:8000/Toy_Management_Website/api/detail_orders/show_order.php?orderID=${idOrder}`)

    if(!Product) {
        productDetailOrder.innerHTML = "<h1>Not found Order!</h1>"
        return;
    }

    let listProduct = Product.detail_orders.map((item) => {
        let total = item.detail_order_list.price * item.detail_order_list.quantity
        return `
            <div class="order-product" key=${item.id}>
                <img src=${'admin/uploads/'+item.detail_order_list.image} alt="">
                <p class="product_name">${item.detail_order_list.name}</p>
                <p class="product_price">$${item.detail_order_list.price}</p>
                <P class="product_quantity">${item.detail_order_list.quantity}</P>
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
