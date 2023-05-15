// let httpFetchCategory =
//     "http://localhost:3000/api/orders/read.php";
let httpFetchCategory =
    "http://localhost:3000/api/detail_orders/read.php";
// let httpFetchCategory =
//     "http://localhost:8000/Toy_Management_Website/api/detail_orders/read.php";
    
let ordersDetail = document.getElementById("orders-details");
const url = window.location.href;
const match = url.match(/id=3&detailid=([^&]*)/);
const idPage = match ? match[1] : null;
const newIdOrders = Number(idPage)


fetch(httpFetchCategory)
    .then((response) => response.json())
    .then((data) => data.detail_order_product)
    .then((data) => {
        let newData = data.filter(item => item.order_id == newIdOrders)
        ShowOrdersDetail(newData);
    })
    .catch((error) => console.error(error));

const ShowOrdersDetail = (data) => {
    data.forEach(item => {
        ordersDetail.innerHTML = ordersDetail.innerHTML + `
        <div class="orders-info">
            <h2 class="orders-id">Order's ID: ${item.order_id}</h2>
        <p class="product-id"><strong>Product ID:</strong> ${item.product_list.product_id}</p>
        <p class="product-quantity"><strong>Quantity:</strong> ${item.product_list.quantity}</p>
        <p class="product-price"><strong>Price:</strong> ${item.product_list.price}</p>
        <div class="orders-actions">
        <button class="delete-button"><a href="orders_detail.php?id=${item.order_id}&deleteid=${item.id}">Delete</a></button>
        </div>`;
    });


};

// ShowOrderDetail
const handleShowCart = () => {
    const layout = document.getElementById("orders-details")
    layout.style.display = "flex";

    // Handle Out Of Area Click
    const screen = document.getElementById("orders-details");
    screen.addEventListener('click', (event) => {
        const box = document.getElementsByClassName('modal-container')[0];
        if (!box.contains(event.target)) {
            handleClose();
        }
    });
}

// CloseOrderDetail
const handleClose = () => {
    const layout = document.getElementById("orders-details")
    layout.style.display = "none";
}
