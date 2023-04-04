let ProductName = document.getElementById("product-name")
let ProductImg = document.getElementById("product-image")
let ProductPrice = document.getElementById("product-price")

const AddActive = (event, id) => {
    event.preventDefault();
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
    } else {
        // add the class
        iCheck.classList.add('fa-check');
        iCheck.classList.remove('fa-plus');

        // get info
        let convertPrice = ProductPrice.innerText.split('$');
        const productInfo = {
            id: id,
            name: ProductName.innerText,
            image: ProductImg.src,
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
            } else {
                const tmpProduct = [];
                tmpProduct.push(productInfo);
                localStorage.setItem('cartAdd', JSON.stringify(tmpProduct));
            }
        }
    }
    // location.reload();
}

const checkAddToCart = (dataId) =>{
    if (localStorage.getItem('cartAdd')) {
        const tmpProduct = JSON.parse(localStorage.getItem('cartAdd'));
        
        return tmpProduct.some(product => product.id === dataId);
    }
    return false;
}

const LoadCheckCart = () => {
    const CartArr =  JSON.parse(localStorage.getItem('cartAdd'));
    CartArr.forEach(item => {
        let iTag = document.getElementById(`icon-check-${item.id}`)
        iTag.classList.remove('fa-plus');
        iTag.classList.add('fa-check');
    })
}

LoadCheckCart()