let productWrapper = document.getElementById("product-wrapper");
let favorite = JSON.parse(localStorage.getItem('favorite'));

const handleLoadCart = (ListFavorite = favorite) => {
    if (!ListFavorite.length) {
        productWrapper.innerHTML = '<h1>Empty</h1>';
        return
    }

    const cartListText = ListFavorite.map((product, index) => {
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
                    <button class="remove-product" data-id="${product.id}" onclick="handleRemove(${product.id})">
                        Remove
                    </button>
                </div>
            </div>`;
    }).join('');

    productWrapper.innerHTML = cartListText;
};

const handleRemove = (id) => {
    let newFavorite = favorite.filter(item => item.id !== id)
    localStorage.setItem('favorite', JSON.stringify(newFavorite));
    location.reload();
}

handleLoadCart(favorite)