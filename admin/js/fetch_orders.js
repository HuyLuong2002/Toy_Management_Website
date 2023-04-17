// let httpFetchCategory =
//     "http://localhost:3000/api/orders/read.php";
let httpFetchCategory =
    "http://localhost:80/Toy_Management_Website/api/detail_orders/read.php";
let ordersDetail = document.getElementById("orders-details");
const url = window.location.href;
const match = url.match(/id=([^&]*)/);
const idPage = match ? match[1] : null;
const newIdOrders = Number(idPage)


fetch(httpFetchCategory)
    .then((response) => response.json())
    .then((data) => data.detail_order_product)
    .then((data) => {
        let newData = data.filter(item => item.order_id == newIdOrders)
        ShowOrdersDetail(newData[0]);
    })
    .catch((error) => console.error(error));

const ShowOrdersDetail = (data) => {
    ordersDetail.innerHTML = `
        <div class="orders-info">
            <h2 class="orders-id">Order's ID: ${data.order_id}</h2>
        <p class="product-id"><strong>Product ID:</strong> ${data.product_list.product_id}</p>
        <p class="product-quantity"><strong>Quantity:</strong> ${data.product_list.quantity}</p>
        <p class="product-price"><strong>Price:</strong> ${data.product_list.price}</p>
        <div class="orders-actions">
        <button class="delete-button"><a href="orders_detail.php?id=${data.order_id}&deleteid=${data.id}">Delete</a></button>
        </div>`;
};
