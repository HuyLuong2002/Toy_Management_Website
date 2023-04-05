
// const ProductDB = new productDB();

const favActive = (event) => {
    event.preventDefault();
    if (event.target.classList.contains('fa-solid')) {
        // remove the class
        event.target.classList.add('fa-regular');
        event.target.classList.remove('fa-solid');

        // remove from localStorage
        const favorite = JSON.parse(localStorage.getItem('favorite'));
        favorite.forEach((product, index) => {
            if (event.target.dataset.id === product.id) {
                favorite.splice(index, 1);
            }
        });
        // set the array into localStorage
        localStorage.setItem('favorite', JSON.stringify(favorite));
    } else {

        // add the class
        event.target.classList.add('fa-solid');
        event.target.classList.remove('fa-regular');

        // get info
        const cardBody = event.target.parentElement.parentElement.parentElement;
        const productInfo = {
            id: event.target.dataset.id,
            name: cardBody.querySelector('.product-name').textContent,
            image: cardBody.querySelector('.product-img').getElementsByTagName('img')[0].src,
            price: cardBody.querySelector('.product-price.product-price-sale').textContent
        }

        if (checkFavorite(productInfo.id)) {
            // Product already in favorites
            console.log('Product already in favorites');
        } else {
            // Add product to favorites
            if (localStorage.getItem('favorite')) {
                const tmpProduct = JSON.parse(localStorage.getItem('favorite'));
                tmpProduct.push(productInfo);
                localStorage.setItem('favorite', JSON.stringify(tmpProduct));
            } else {
                const tmpProduct = [];
                tmpProduct.push(productInfo);
                localStorage.setItem('favorite', JSON.stringify(tmpProduct));
            }
            console.log('Product added to favorites');
        }
    }
}

function checkFavorite(dataId) {
    if (localStorage.getItem('favorite')) {
        const tmpProduct = JSON.parse(localStorage.getItem('favorite'));
        for (let i = 0; i < tmpProduct.length; i++) {
            if (tmpProduct[i].id === dataId) {
                return true;
            }
        }
    }
    return false;
}
