const AddActive = (event) => {
    event.preventDefault();
    if (event.target.classList.contains('fa-check')) {
        // remove the class
        event.target.classList.add('fa-plus');
        event.target.classList.remove('fa-check');

        // remove from localStorage
        const add_to_cart = JSON.parse(localStorage.getItem('add_to_cart'));
        // add_to_cart.forEach((product, index) => {
        //     if (event.target.dataset.id === product.id) {
        //         add_to_cart.splice(index, 1);
        //     }
        // });
        const index = add_to_cart.findIndex(product => product.id === event.target.dataset.id);
        if (index !== -1) {
            add_to_cart.splice(index, 1);
            localStorage.setItem('add_to_cart', JSON.stringify(add_to_cart));
        }
        // set the array into localStorage
        localStorage.setItem('add_to_cart', JSON.stringify(add_to_cart));
    } else {

        // add the class
        event.target.classList.add('fa-check');
        event.target.classList.remove('fa-plus');

        // get info
        const cardBody = event.target.parentElement.parentElement.parentElement;
        const productInfo = {
            id: event.target.dataset.id,
            name: cardBody.querySelector('.product-name').textContent,
            // image: cardBody.querySelector('.product-img').getElementsByTagName('img')[0].src,
            image: cardBody.querySelector('.product-img img').src,
            price: cardBody.querySelector('.product-price.product-price-sale').textContent,
            quantity: event.target.dataset.quantity
        }

        if (checkAddtoCart(productInfo.id)) {
            // Product already in cart
            console.log('Product already in Cart');
        } else {
            // Add product to cart
            if (localStorage.getItem('add_to_cart')) {
                const tmpProduct = JSON.parse(localStorage.getItem('add_to_cart'));
                tmpProduct.push(productInfo);
                localStorage.setItem('add_to_cart', JSON.stringify(tmpProduct));
            } else {
                const tmpProduct = [];
                tmpProduct.push(productInfo);
                localStorage.setItem('add_to_cart', JSON.stringify(tmpProduct));
            }
            console.log('Product added to Cart');
        }
    }
}

function checkAddtoCart(dataId) {
    if (localStorage.getItem('add_to_cart')) {
        const tmpProduct = JSON.parse(localStorage.getItem('add_to_cart'));
        // for (let i = 0; i < tmpProduct.length; i++) {
        //     if (tmpProduct[i].id === dataId) {
        //         return true;
        //     }
        // }
        return tmpProduct.findIndex(product => product.id === dataId) !== -1;
    }
    return false;
}