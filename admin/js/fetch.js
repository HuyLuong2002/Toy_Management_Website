let httpFetchCategory =http://localhost:3000/api/product/read.php
  "";
let productDetail = document.getElementById("product-details");
const url = window.location.href;
const match = url.match(/id=([^&]*)/);
const idPage = match ? match[1] : null;
const newIdProduct = Number(idPage)


fetch(httpFetchCategory)
  .then((response) => response.json())
  .then((data) => data.product)
  .then((data) => {
    let newData = data.filter(item => item.id == newIdProduct)
    ShowProductDetail(newData[0]);
  })
  .catch((error) => console.error(error));

const ShowProductDetail = (data) => {

    productDetail.innerHTML = `
        <div class="product-image">
        <img src="uploads/${data.image}" alt="Product Image">
      </div>
      <div class="product-info">
        <h2 class="product-title"> ${data.name}</h2>
        <p class="product-id"><strong>ID:</strong> ${data.id}</p>
        <p class="product-category"><strong>Category:</strong> ${data.category_id}</p>
        <p class="product-price"><strong>Price:</strong> ${data.price}</p>
        <p class="product-create-date"><strong>Create Date:</strong> ${data.create_date}</p>
        <p class="product-highlight"><strong>Highlight:</strong> ${data.highlight}</p>
        <p class="product-sale-id"><strong>Sale ID:</strong> ${data.sale_id}</p>
        <p class="product-review"><strong>Review:</strong> ${data.review}</p>
        <p class="product-quantity"><strong>Quantity:</strong> ${data.quantity}</p>
        <div class="product-actions">
          <button class="edit-button">Edit</button>
          <button class="delete-button">Delete</button>
        </div>`;
};
