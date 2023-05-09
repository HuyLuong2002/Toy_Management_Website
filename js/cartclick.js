const AddActive = (event, id) => {
    let ProductNameCart = document.getElementById(`product-name-${id}`)
    let ProductImgCart = document.getElementById(`product-image-${id}`)
    let ProductPriceCart = document.getElementById(`product-price-${id}`)

    let iCheck = document.getElementById(`icon-check-${id}`)
    if (iCheck.classList.contains('fa-check')) {
        // remove the class
        iCheck.classList.add('fa-plus');
        iCheck.classList.remove('fa-check');

        // remove from localStorage
        const cartAdd = JSON.parse(localStorage.getItem('cartAdd'));
        const newCartAdd = cartAdd.filter(item => item.id !== id)

        // set the array into localStorage
        localStorage.setItem('cartAdd', JSON.stringify(newCartAdd));
        document.cookie = "cartAdd=" + JSON.stringify(newCartAdd) + ";expires=" + new Date(Date.now() + 86400000).toUTCString() + ";path=/";
    } else {
        // add the class
        iCheck.classList.add('fa-check');
        iCheck.classList.remove('fa-plus');

        // get info
        let convertPrice = ProductPriceCart.innerText.split('$');
        const productInfo = {
            id: id,
            name: ProductNameCart.innerText,
            image: ProductImgCart.src,
            price: parseFloat(convertPrice[1]),
            quantity: 1
        }

        if (checkAddToCart(productInfo.id)) {
            // Product already in cart
            alert('Product already in Cart');
        } else {
            // Add product to cart
            if (localStorage.getItem('cartAdd')) {
                const tmpProduct = JSON.parse(localStorage.getItem('cartAdd'));
                tmpProduct.push(productInfo);
                localStorage.setItem('cartAdd', JSON.stringify(tmpProduct));
                document.cookie = "cartAdd=" + JSON.stringify(tmpProduct) + ";expires=" + new Date(Date.now() + 86400000).toUTCString() + ";path=/";
            } else {
                const tmpProduct = [];
                tmpProduct.push(productInfo);
                localStorage.setItem('cartAdd', JSON.stringify(tmpProduct));
            }
        }
    }
    // location.reload();
    AmountCartWasAdded()
}

const checkAddToCart = (dataId) => {
    if (localStorage.getItem('cartAdd')) {
        const tmpProduct = JSON.parse(localStorage.getItem('cartAdd'));

        return tmpProduct.some(product => product.id === dataId);
    }
    return false;
}

const LoadCheckCart = () => {
    const CartArr = JSON.parse(localStorage.getItem('cartAdd'));
    CartArr.forEach(item => {
        let iTag = document.getElementById(`icon-check-${item.id}`)
        if(iTag) {
            iTag.classList.remove('fa-plus');
            iTag.classList.add('fa-check');
        }
    })

    AmountCartWasAdded()
}

const AmountCartWasAdded = () => {
    let CartAdd = JSON.parse(localStorage.getItem('cartAdd'));
    let FavoriteAdd = JSON.parse(localStorage.getItem('favorite'));
    
    document.getElementById("cart").innerText = `(${CartAdd.length})`;
    document.getElementById("favorite").innerText = `(${FavoriteAdd.length})`;
}
LoadCheckCart()