let taxRate = 0.05;
let shippingRate = 15.0;
let fadeTime = 300;

let productWrapper = document.getElementById("wrap-product-left");
let totalWrapper = document.getElementById("wrap-totals");
let CartAdd = JSON.parse(localStorage.getItem('cartAdd'));
let ShipInfo = JSON.parse(localStorage.getItem('shipInfo'));

const handleLoadPayCheck = () => {
    if (!CartAdd.length) {
        productWrapper.innerHTML = "<h1>Empty</h1>";
        return;
    }

    const cartListText = CartAdd.map((product, index) => { 
        let total = (parseFloat(product.price) * product.quantity).toFixed(2)
        return `
            <div class="products" key=${index}>
                <div class="product_image">
                    <img src="${product.image}">
                </div>
                <div class="product_details">
                    <span class="product_name">${product.name}</span>
                    <span class="quantity">X${product.quantity}</span>
                    <span class="price">$${product.price}</span>
                    <span class="total-price" id="total-price">$${total}</span>
                </div>
            </div>`;
    }).join('');

    productWrapper.innerHTML = cartListText;
}

const handleCalculateTotal = () => {
    let cartSubTotal = CartAdd.reduce((acc, cur) => acc + cur.price * cur.quantity, 0)
    let tax = parseFloat((cartSubTotal * (10 / 100)).toFixed(3))
    let shipFee = ShipInfo.shipFee
    let grandTotal = (cartSubTotal + tax + shipFee).toFixed(2)

    let totalHTML = `
        <div class="totals">
            <span class="subtitle">Subtotal <span id="sub_price">$${cartSubTotal}</span></span>
            <span class="subtitle">Tax <span id="sub_tax">$${tax}</span></span>
            <span class="subtitle">Shipping <span id="sub_ship">$${shipFee}</span></span>
        </div>
        <div class="final">
            <span class="title">Total <span id="calculated_total">$${grandTotal}</span></span>
        </div>`;

    let newShipInfo = ShipInfo
    newShipInfo.vat = tax
    localStorage.setItem("shipInfo", JSON.stringify(newShipInfo));
    totalWrapper.innerHTML = totalHTML;
};

handleLoadPayCheck()
handleCalculateTotal()