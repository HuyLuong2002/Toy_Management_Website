let products_1 = [...document.querySelectorAll(".product.id-1")];
let products_2 = [...document.querySelectorAll(".product.id-2")];
let ProductItem = document.getElementById("product-items")

let currentItem1 = 4;
let currentItem2 = 4;
let flag1 = 1;
let flag2 = 1;
let countProduct1 = 0
let countProduct2 = 0

let arrContainer = [[...products_1], [...products_2]]

const handleLoadMore = (result) => {
    let btnLoadMore = document.getElementById(`load-more-${result}`);
    let btnUnload = document.getElementById(`unload-${result}`);
    if (result === 1) {
        countProduct1 = currentItem1*++flag1
        if (countProduct1 >= products_1.length) {
            btnLoadMore.style.display = "none";
            btnUnload.style.display = "block";
        }
        showProductList(products_1, products_2, countProduct1, currentItem2)
    }

    if (result === 2) {
        console.log("cc");
        countProduct2 = currentItem2*++flag2
        
        if (countProduct2 >= products_2.length) {
            btnLoadMore.style.display = "none";
            btnUnload.style.display = "block";
        }
        showProductList(products_1, products_2, currentItem1, countProduct2)
    }
};

const handleUnload = (result) => {
    console.log("result: ", result);
    let btnLoadMore = document.getElementById(`load-more-${result}`);
    let btnUnload = document.getElementById(`unload-${result}`);
    if (result === 1) {
        for (var i = 4; i < products_1.length; i++) {
            products_1[i].style.display = "none";
        }
        if (btnLoadMore !== null && btnUnload !== null) {
            btnLoadMore.style.display = "block";
            btnUnload.style.display = "none";
        }
    }

    if (result === 2) {
        for (var i = 4; i < products_2.length; i++) {
            products_2[i].style.display = "none";
        }
        if (btnLoadMore !== null && btnUnload !== null) {
            btnLoadMore.style.display = "block";
            btnUnload.style.display = "none";
        }
    }
};

// const executeShowLoad = (arrCon = [], count) => {
//     if(arrCon) {
//         arrCon.forEach((product, index) => {
//             if(product.length > 4) {
//                 for (let i = count; i < product.length; i++) 
//                     product[i].style.display = "none";
    
//                 if(count >= product.length) {
//                     for(let i = 0; i < product.length; i++)
//                         product[i].style.display = "block";
//                 } else {
//                     for(let i = 0; i < count; i++)
//                         product[i].style.display = "block";
//                 }
                
//             } else {
//                 document.getElementById(`load-more-${index}`).style.display = "none";
//             }
//         })
//     }
// }


const showProductList = (arr1, arr2, current1, current2) => {
    
    if(arr1) {
        if(arr1.length > 4) {
            for (let i = current1; i < arr1.length; i++) 
                arr1[i].style.display = "none";

            if(current1 >= arr1.length) {
                for(let i = 0; i < arr1.length; i++)
                    arr1[i].style.display = "block";
            } else {
                for(let i = 0; i < current1; i++)
                    arr1[i].style.display = "block";
            }
            
        } else {
            let loadMore1 = document.getElementById(`load-more-1`)
            if(loadMore1) loadMore1.style.display = "none";
        }
    }

    if(arr2) {
        if(arr2.length > 4) {
            for (let i = current2; i < arr2.length; i++) {
                arr2[current2].style.display = "none";
            }

            if(current2 >= arr2.length) {
                for(let i = 0; i < arr2.length; i++)
                    arr2[i].style.display = "block";
            } else {
                for(let i = 0; i < current2; i++)
                    arr2[i].style.display = "block";
            }
        } else {
            let loadMore2 = document.getElementById(`load-more-2`)
            if(loadMore2) loadMore2.style.display = "none";
        }
    }
}

showProductList(products_1, products_2, currentItem1, currentItem2)