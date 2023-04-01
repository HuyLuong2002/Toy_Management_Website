class productDB{
    
    // Save products into local storage
    saveIntoDB(product){
        const products = this.getFromDB();
        products.push(product);
        // Add the new array into the local storage
        localStorage.setItem('products', JSON.stringify(products));
    }

    // Return products from local storage
    getFromDB(){
        let products;
        // Check from localstorage
        if(localStorage.getItem("products") === null){
            products = [];
        } else {
            products = JSON.parse(localStorage.getItem("products"));
        }
        return products;
    } 
}