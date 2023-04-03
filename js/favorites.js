/* Set rates + misc */
let taxRate = 0.05;
let shippingRate = 15.0;
let fadeTime = 300;

let productWrapper = document.getElementById("product-wrapper");
// let totalWrapper = document.getElementById("wrap-total");

let products = JSON.parse(localStorage.getItem('products'));

const handleLoadCart = () => {
    if (!products.length) {
        productWrapper.innerHTML = '<h1>Empty</h1>';
        return
    }

    const cartListText = products.map((product, index) => {
            return `
            <div class="product" key="${index}">
                <div class="product-image">
                    <img src="${product.image}">
                </div>
                <div class="product-details">
                    <div class="product-title">${product.name}</div>
                </div>
                <div class="product-price" id="product-price">${product.price}</div>
                <div class="product-removal">
                    <button class="remove-product" data-id="${product.id}" onclick="handleRemove(event)">
                        Remove
                    </button>
                </div>
            </div>`;
    }).join('');

    productWrapper.innerHTML = cartListText;

};

const handleRemove = (e) => {
    // remove from DOM
    e.target.parentElement.parentElement.remove();
    // remove from localStorage
    products.forEach((product, index) => {
        if(e.target.dataset.id === product.id){
            products.splice(index, 1);
        }
    });
    // set the array into localStorage
    localStorage.setItem('products', JSON.stringify(products));
}

handleLoadCart()