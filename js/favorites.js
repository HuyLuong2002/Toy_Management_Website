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
                    <img src="${product.image}" id="product-image-${product.id}">
                </div>
                <div class="product-details">
                    <div class="product-title" id="product-name-${product.id}">${product.name}</div>
                </div>
                <div class="product-price" id="product-price-${product.id}">$${product.price}</div>
                <div class="product-more-detail">
                <a
                        href="product_detail.php?id=${product.id}&categoryID=${product.categoryID}">
                        <button class="btn-buy">
                          More Details
                          <span><i class="fa-solid fa-circle-info"></i> </span>
                        </button>
                      </a>
                      </div>
                      <div class="product-add-to-cart">
                      <button class="btn-cart" onclick="AddActive(event, ${product.id})"
                        data-id="${product.id}" data-quantity=1>
                        Add to cart
                        <i class="fa-solid fa-plus add-icon" id="icon-check-${product.id}"></i>
                      </button>
                      </div>
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

