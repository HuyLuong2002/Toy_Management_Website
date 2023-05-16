let ProductItem = document.getElementById("product-items")
// let apiCate = "http://localhost:8000/Toy_Management_Website/api/category/read.php"
let apiCate = "http://localhost:8080/Toy_Management_Website/api/category/read.php"
// let apiCate = "http://localhost:3000/api/category/read.php"

let arrContainer = []
let currentItemsList = []
let flags = []
let countProduct = []
let arrAmountLoop = []

const fetchAPICate = async (api) => {
    return await fetch(api)
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.error(error));
}

const showProductList = async () => {
    let cateList = await fetchAPICate(apiCate)

    if (!cateList) {
        ProductItem.innerHTML = "<h1>Not found Product!</h1>";
        return;
    }

    cateList.category.forEach(item => {
        arrContainer.push([...document.querySelectorAll(`.product.id-${item.id}`)])
        currentItemsList.push(4)
        flags.push(1)
        countProduct.push(0)
        arrAmountLoop.push(item.id)
    })

    executeShowLoad(arrContainer, currentItemsList, arrAmountLoop)
}

function isArrayContained(arr1, arr2) {
    return arr1.every(function(element) {
        return arr2.includes(element);
    });
}

const executeShowLoad = async (arrContainer, count, lengthArrLoop) => {
    let cateListAPI = await fetchAPICate(apiCate)
    let cateList = cateListAPI.category

    let newArr = []
    cateList.forEach(item => newArr.push(item.id))

    for(let i = 0; i < cateList.length; i++) {
        let checkFlag = i + 1
        if(isArrayContained(lengthArrLoop, newArr) || checkFlag === lengthArrLoop[0]) {
            if(arrContainer[i].length > 4) {
                for (let j = count[i]; j < arrContainer[i].length; j++) 
                    arrContainer[i][j].style.display = "none";
    
                if(count[i] >= arrContainer[i].length) {
                    for(let j = 0; j < arrContainer[i].length; j++)
                        arrContainer[i][j].style.display = "block";
                } else {
                    if(count[i] === 0) {
                        count[i] = 4
                    }
                    for(let j = 0; j < count[i]; j++)
                        arrContainer[i][j].style.display = "block";
                }
            } else if(arrContainer[i].length > 0) {
                let loadMoreCheck = document.getElementById(`load-more-${cateList[i].id}`)
                if(loadMoreCheck)
                    loadMoreCheck.style.display = "none";
            } else {
                let loadMoreCheck = document.getElementById(`load-more-${cateList[i].id}`);
                let btnUnload = document.getElementById(`unload-${cateList[i].id}`);
                if(loadMoreCheck)
                    loadMoreCheck.style.display = "none";
                if(btnUnload)
                    btnUnload.style.display = "none";
            }
        }
    }
}

const handleLoadMore = async (result) => {
    let cateList = await fetchAPICate(apiCate)

    let btnLoadMore = document.getElementById(`load-more-${result}`);
    let btnUnload = document.getElementById(`unload-${result}`);


    if(!cateList) {
        ProductItem.innerHTML = "<h1>Not found Product!</h1>";
        return;
    }

    for(let i = 0; i < cateList.category.length; i++) {
        if(result === cateList.category[i].id) {
            countProduct[i] = currentItemsList[i]*++flags[i]
            if(countProduct[i] >= arrContainer[i].length) {
                btnLoadMore.style.display = "none";
                btnUnload.style.display = "block";
                countProduct[i] = arrContainer[i].length
            }
            console.log("Count: ", countProduct[i]);
            console.log("CurrentItemList: ", currentItemsList[i]);
            console.log("Flags: ", flags[i]);
            executeShowLoad(arrContainer, countProduct, [result, 0])
        }
    }
};

const handleUnload = async (result) => {
    let cateList = await fetchAPICate(apiCate)

    let btnLoadMore = document.getElementById(`load-more-${result}`);
    let btnUnload = document.getElementById(`unload-${result}`);

    if(!cateList) {
        ProductItem.innerHTML = "<h1>Not found Product!</h1>";
        return;
    }

    for(let i = 0; i < cateList.category.length; i++) {
        if(result === cateList.category[i].id) {
            for (let j = 4; j < arrContainer[i].length; j++) {
                arrContainer[i][j].style.display = "none";
            }
            if (btnLoadMore !== null && btnUnload !== null) {
                btnLoadMore.style.display = "block";
                btnUnload.style.display = "none";
            }
        }
    }
};

showProductList()