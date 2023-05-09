/* Set rates + misc */
let taxRate = 0.05;
let shippingRate = 15.0;
let fadeTime = 300;

let productWrapper = document.getElementById("product-wrapper");
let totalWrapper = document.getElementById("wrap-total");
let CartAdd = JSON.parse(localStorage.getItem('cartAdd'));


const handleLoadCart = (cartList = []) => {
    if (!cartList.length) {
        productWrapper.innerHTML = "<h1>Empty</h1>";
        return;
    }

    const cartListText = cartList.map((product, index) => { 
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

const handleChangeQuantity = async (id) => {
    let inputNumber = document.getElementById(`quantity-${id}`)
    let apiGetProductById = await fetchAPI(`http://localhost:8000/Toy_Management_Website/api/product/show.php?id=${id}`)
    if(checkProductInStock(id, apiGetProductById.quantity)) {
        let quantity = parseInt(document.getElementById("quantity-" + id).value)
        const newCartAdd = CartAdd.map(item => {
            if(item.id === id) item.quantity = quantity;
            return item
        })
        localStorage.setItem('cartAdd', JSON.stringify(newCartAdd));
        document.cookie = "cartAdd=" + JSON.stringify(newCartAdd) + ";expires=" + new Date(Date.now() + 86400000).toUTCString() + ";path=/";
        handleLoadCart(newCartAdd)
        handleCalculateTotal(newCartAdd)
    } else {
        let cartFail = document.getElementById("cart-fail-1")


        inputNumber.value = apiGetProductById.quantity
        const newCartAdd = CartAdd.map(item => {
            if(item.id === id) item.quantity = apiGetProductById.quantity;
            return item
        })
        localStorage.setItem('cartAdd', JSON.stringify(newCartAdd));
        

        cartFail.style.display = "block"
        cartFail.classList.add("hide")

        setTimeout(function() {
            cartFail.style.display = 'none';
            cartFail.classList.remove('hide');
        }, 3000);
        return;
    }
}


const fetchAPI = async (api) => {
    return await fetch(api)
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.error(error));
}

const checkProductInStock = (id, quantity) => {
    let inputNumber = document.getElementById(`quantity-${id}`)
    
    // console.log("current: ", inputNumber.value);
    // console.log("db: ", quantity);

    return inputNumber.value > quantity ? false : true
}

const handleCalculateTotal = (cartList = CartAdd) => {
    let cartSubTotal = cartList.reduce((acc, cur) => acc + cur.price * cur.quantity, 0)
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

const handleCheckCheckOut = (event) => {
    let checkFail = document.getElementById("cart-fail")
    if(!CartAdd.length) {
        checkFail.style.display = "block"
        checkFail.classList.add("hide")

        setTimeout(function() {
            checkFail.style.display = 'none';
            checkFail.classList.remove('hide');
        }, 3000);
        event.preventDefault();
    }
}

handleLoadCart(CartAdd)
handleCalculateTotal(CartAdd)
