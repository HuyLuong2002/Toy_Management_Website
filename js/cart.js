/* Set rates + misc */
let taxRate = 0.05;
let shippingRate = 15.0;
let fadeTime = 300;

let productWrapper = document.getElementById("product-wrapper");
let totalWrapper = document.getElementById("wrap-total");
let add_to_cart = JSON.parse(localStorage.getItem('add_to_cart'));

const handleLoadCart = () => {
    if (!add_to_cart.length) {
        productWrapper.innerHTML = "<h1>Empty</h1>";
        return;
    }

    const cartListText = add_to_cart.map((product, index) => { 
        let arr = product.price.split('$');
        console.log(arr);
        let total = (parseFloat(arr[1]) * parseFloat(product.quantity)).toFixed(2)
        return `
                <div class="product" key="${index}">
                    <div class="product-image">
                        <img src="${product.image}">
                    </div>
                    <div class="product-details">
                        <div class="product-title">${product.name}</div>
                    </div>
                    <div class="product-price" id="product-price">${product.price}</div>
                    <div class="product-quantity">
                        <input onKeyDown="return false" id="quantity-${product.id}" type="number" value="${product.quantity}" min="1" onchange="handleChangeQuantity(${product.id}, ${index})">
                    </div>
                    <div class="product-line-price">${total}</div>
                    <div class="product-removal">
                        <button class="remove-product" onclick="handleRemove(${product.id})">
                            Remove
                        </button>
                    </div>
                </div>`;
    }).join('');

    productWrapper.innerHTML = cartListText;
}


let productList = [
    {
        id: 1,
        img: "./assets/images/home-img-1.png",
        title: "Chú bé Iron man",
        desc: "Holyshit, the best toy that i have ever seen. I'm a fan.",
        quantity: 1,
        price: 12.99,
    },
    {
        id: 2,
        img: "./assets/images/home-img-2.png",
        title: "Chú bé captain",
        desc: "Holyshit, the best toy that i have ever seen. I'm a fan.",
        quantity: 2,
        price: 12.99,
    },
    {
        id: 3,
        img: "./assets/images/home-img-3.png",
        title: "Chú bé da xanh",
        desc: "Holyshit, the best toy that i have ever seen. I'm a fan.",
        quantity: 2,
        price: 12.99,
    },
];

const handleChangeQuantity = (id, index) => {
    let quantity = parseInt(document.getElementById("quantity-" + id).value)
    productList[index].quantity = quantity
    // handleLoadCart()
    // handleCalculateTotal()
}

const handleCalculateTotal = () => {
    let cartSubTotal = add_to_cart.reduce((acc, cur) => acc + cur.price * cur.quantity, 0)
    let tax = parseFloat((cartSubTotal * (5 / 100)).toFixed(3))
    let shipFee = 15
    let grandTotal = (cartSubTotal + tax + shipFee).toFixed(2)

    let totalHTML = `
        <div class="totals">
            <div class="totals-item">
                <label>Subtotal</label>
                <div class="totals-value" id="cart-subtotal">${cartSubTotal.toFixed(2)}</div>
            </div>
            <div class="totals-item">
                <label>Tax (5%)</label>
                <div class="totals-value" id="cart-tax">${tax}</div>
            </div>
            <div class="totals-item">
                <label>Shipping</label>
                <div class="totals-value" id="cart-shipping">${shipFee}.00</div>
            </div>
            <div class="totals-item totals-item-total">
                <label>Grand Total</label>
                <div class="totals-value" id="cart-total">${grandTotal}</div>
            </div>
        </div>`;

    totalWrapper.innerHTML = totalHTML;
};

const handleRemove = (e) => {
    // productList = productList.filter(product => product.id !== id)
    // handleLoadCart()
    // handleCalculateTotal()

    // remove from DOM
    e.target.parentElement.remove();

    // remove from localStorage
    add_to_cart.forEach((product, index) => {
        if (e.target.dataset.id === product.id) {
            product.splice(index, 1);
        }
    });

    // set the array into localStorage
    localStorage.setItem('add_to_cart', JSON.stringify(add_to_cart));
}

handleLoadCart()
handleCalculateTotal()