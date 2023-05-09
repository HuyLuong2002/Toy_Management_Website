/* Set rates + misc */
let taxRate = 0.05;
let shippingRate = 15.0;
let fadeTime = 300;

let productWrapper = document.getElementById("product-wrapper");
let totalWrapper = document.getElementById("wrap-total");
let CartAdd = JSON.parse(localStorage.getItem('cartAdd'));

const handleLoadCart = () => {
    if (!CartAdd.length) {
        productWrapper.innerHTML = "<h1>Empty</h1>";
        return;
    }

    const cartListText = CartAdd.map((product, index) => { 
        let total = (parseFloat(product.price) * product.quantity).toFixed(2)
        return `
                <div class="product" key="${index}">
                    <div class="product-image">
                        <img src="${product.image}">
                    </div>
                    <div class="product-details">
                        <div class="product-title">${product.name}</div>
                    </div>
                    <div class="product-price" id="product-price">$${product.price}</div>
                    <div class="product-quantity">
                        <input onKeyDown="return false" id="quantity-${product.id}" type="number" value="${product.quantity}" min="1" onchange="handleChangeQuantity(${product.id})">
                    </div>
                    <div class="product-line-price">$${total}</div>
                    <div class="product-removal">
                        <button class="remove-product" onclick="handleRemove(${product.id})">
                            Remove
                        </button>
                    </div>
                </div>`;
    }).join('');

    productWrapper.innerHTML = cartListText;
}

const handleChangeQuantity = (id) => {
    let quantity = parseInt(document.getElementById("quantity-" + id).value)
    const newCartAdd = CartAdd.map(item => {
       if(item.id === id) item.quantity = quantity;
       return item
    })
    localStorage.setItem('cartAdd', JSON.stringify(newCartAdd));
    document.cookie = "cartAdd=" + JSON.stringify(newCartAdd) + ";expires=" + new Date(Date.now() + 86400000).toUTCString() + ";path=/";
    location.reload();
}

const handleCalculateTotal = () => {
    let cartSubTotal = CartAdd.reduce((acc, cur) => acc + cur.price * cur.quantity, 0)
    let tax = parseFloat((cartSubTotal * (10 / 100)).toFixed(3))
    let shipFee = 12
    let grandTotal = (cartSubTotal + tax + shipFee).toFixed(2)

    let totalHTML = `
        <div class="totals">
            <div class="totals-item">
                <label>Subtotal</label>
                <div class="totals-value" id="cart-subtotal">$${cartSubTotal.toFixed(2)}</div>
            </div>
            <div class="totals-item">
                <label>Tax (10%)</label>
                <div class="totals-value" id="cart-tax">$${tax}</div>
            </div>
            <div class="totals-item">
                <label>Shipping</label>
                <div class="totals-value" id="cart-shipping">$${shipFee}.00</div>
            </div>
            <div class="totals-item totals-item-total">
                <label>Grand Total</label>
                <div class="totals-value" id="cart-total">$${grandTotal}</div>
            </div>
        </div>`;

    totalWrapper.innerHTML = totalHTML;
};

const handleRemove = (id) => {
    const newCartAdd = CartAdd.filter(item => item.id !== id)
    localStorage.setItem('cartAdd', JSON.stringify(newCartAdd));
    location.reload();
}

handleLoadCart()
handleCalculateTotal()