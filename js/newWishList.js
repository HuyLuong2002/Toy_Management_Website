const AddFavorite = (event, id) => {
    let ProductNameCart = document.getElementById(`product-name-${id}`)
    let ProductImgCart = document.getElementById(`product-image-${id}`)
    let ProductPriceCart = document.getElementById(`product-price-${id}`)

    let iCheck = document.getElementById(`favorite-${id}`)
    if (iCheck.classList.contains('fa-solid')) {
        // remove the class
        iCheck.classList.add('fa-regular');
        iCheck.classList.remove('fa-solid');

        // remove from localStorage
        const cartAdd = JSON.parse(localStorage.getItem('favorite'));
        const newCartAdd = cartAdd.filter(item => item.id !== id)

        // set the array into localStorage
        localStorage.setItem('favorite', JSON.stringify(newCartAdd));
        document.cookie = "favorite=" + JSON.stringify(newCartAdd) + ";expires=" + new Date(Date.now() + 86400000).toUTCString() + ";path=/";
    } else {
        // add the class
        iCheck.classList.add('fa-solid');
        iCheck.classList.remove('fa-regular');

        // get info
        let convertPrice = ProductPriceCart.innerText.split('$');
        const productInfo = {
            id: id,
            name: ProductNameCart.innerText,
            image: ProductImgCart.src,
            price: parseFloat(convertPrice[1]),
            quantity: 1
        }

        if (checkAddToFavorite(productInfo.id)) {
            // Product already in cart
            // alert('Product already in Favorite');
        } else {
            // Add product to cart
            if (localStorage.getItem('favorite')) {
                const tmpProduct = JSON.parse(localStorage.getItem('favorite'));
                tmpProduct.push(productInfo);
                localStorage.setItem('favorite', JSON.stringify(tmpProduct));
                document.cookie = "favorite=" + JSON.stringify(tmpProduct) + ";expires=" + new Date(Date.now() + 86400000).toUTCString() + ";path=/";
            } else {
                const tmpProduct = [];
                tmpProduct.push(productInfo);
                localStorage.setItem('favorite', JSON.stringify(tmpProduct));
            }
        }
    }
    AmountHeartWasAdded()
}

const checkAddToFavorite = (dataId) => {
    if (localStorage.getItem('favorite')) {
        const tmpProduct = JSON.parse(localStorage.getItem('favorite'));

        return tmpProduct.some(product => product.id === dataId);
    }
    return false;
}

const LoadActiveHeart = () => {
    const CartArr = JSON.parse(localStorage.getItem('favorite'));
    CartArr.forEach(item => {
        let iTag = document.getElementById(`favorite-${item.id}`)
        iTag.classList.remove('fa-regular');
        iTag.classList.add('fa-solid');
    })

    AmountHeartWasAdded()
}

const AmountHeartWasAdded = () => {
    let CartAdd = JSON.parse(localStorage.getItem('cartAdd'));
    let FavoriteAdd = JSON.parse(localStorage.getItem('favorite'));
    
    document.getElementById("cart").innerText = `(${CartAdd.length})`;
    document.getElementById("favorite").innerText = `(${FavoriteAdd.length})`;
}

LoadActiveHeart()