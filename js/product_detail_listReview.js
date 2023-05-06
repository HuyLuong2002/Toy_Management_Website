let listUserReview = document.getElementById("list-user-review")
let formReview = document.getElementById("wrap-list-reviews")
let btnAddReview = document.getElementById("submit-review")
let txtReview = document.getElementById('review-opinion')
let getAllStar = document.querySelectorAll('.rating .star')

let newReview = {
    product_id: "",
    username: "",
    content: "",
    rate: 0,
    img: ""
}

// const listReview = [
//     {
//         id: 1,
//         userId: "blabla",
//         productId: "blabla",
//         review: "San pham nhu cai dau bui re rach",
//         reply: [
//             {
//                 id: 1,
//                 userId: "blabla",
//                 review: "San pham nhu cai dau bui re rach",
//                 img: "./assets/images/pic-6.png",
//                 createdAt: new Date(),
//                 updatedAt: new Date(),
//             }
//         ],
//         countStar: 3,
//         img: "./assets/images/pic-6.png",
//         createdAt: new Date(),
//         updatedAt: new Date(),
//         dateTime: "24/4/2023, 10:12:26",
//         username: "Chú bé đôgêmon",
//     },
//     {
//         id: 2,
//         username: "Chú bé đôgêmon",
//         review: "San pham nhu cai dau bui re rach",
//         dateTime: "24/4/2023, 10:12:26",
//         countStar: 1,
//         img: "./assets/images/pic-6.png"
//     },
//     {
//         id: 3,
//         username: "Viên Huy Lương",
//         review: "San pham nhu cai dau bui re rach",
//         dateTime: "24/4/2023, 10:12:26",
//         countStar: 4,
//         img: "./assets/images/pic-6.png"
//     },
//     {
//         id: 4,
//         username: "Ông Hoàng",
//         review: "San pham nhu cai dau bui re rach",
//         dateTime: "24/4/2023, 10:12:26",
//         countStar: 2,
//         img: "./assets/images/pic-6.png"
//     },
//     {
//         id: 5,
//         username: "Luccode",
//         review: "San pham nhu cai dau bui re rach",
//         dateTime: "24/4/2023, 10:12:26",
//         countStar: 0,
//         img: "./assets/images/pic-6.png"
//     }
// ]

// Call API all comments of product
const listReview = []

let arrStar = [0,0,0,0,0]

const handleShowListReview = (arr = listReview) => {
    if (!arr.length) {
        listUserReview.innerHTML = "<h1>Not found review!</h1>";
        return;
    }

    const ListUserReview = arr.map((rev, index) => { 
        let flag = 0
        return `
            <div class="use-review" key="${index}">
                <img src="${rev.img}" alt="avatar">
                <div class="detail-review">
                    <p style="font-weight: 900;">${rev.username}</p>
                    <p>${rev.content}</p>
                    <div class="more-detail">
                        <div class="rating">
                        <input type="number" name="rating" hidden>
                        ${
                            arrStar.map((star, i) => {
                                return flag++ < rev.rate ? `<i class='bx bxs-star' style="--i: ${i};"></i>` : `<i class='bx bx-star' style="--i: ${i};"></i>`
                            }).join("")
                        }
                        </div>
                        <span>${rev.date}</span>
                    </div>
                </div>
            </div>
        `;
    }).join('');

    listUserReview.innerHTML = ListUserReview;
}

const HandleShowListReview = () => {
    formReview.style.display = "flex"
    handleShowListReview(listReview)
    console.log(getAllStar);
}

const handleClose = () => {
    formReview.style.display = "none"
}

const countStarReview = () => {
    let checkStar = 0
    getAllStar.forEach(item => {
        if(item.classList.contains("bxs-star"))
            checkStar++
    })
    return checkStar
}

const fetchAPI = async (api) => {
    return await fetch(api)
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.error(error));
}

const handleAddReview = async (event, userId, productId) => {
    event.preventDefault();
    let apiGetCurrentUser = await fetchAPI(`http://localhost:8000/Toy_Management_Website/api/accounts/show.php?id=${userId}`) 
    let apiGetCurrentProduct = await fetchAPI(`http://localhost:8000/Toy_Management_Website/api/product/show.php?id=${productId}`)
    newReview = {
        product_id: apiGetCurrentProduct.id,
        username: apiGetCurrentUser.username,
        content: txtReview.value,
        rate: countStarReview(),
        img: apiGetCurrentUser.img || "./assets/images/pic-6.png",
        date: new Date().toDateString()
    }

    console.log(newReview);
    listReview.unshift(newReview)
    handleShowListReview(listReview)
    txtReview.value = ""
}

// const handleAddReview = (event, userId, productId) => {
//     event.preventDefault();
//     let newReview = {
//         id: listReview.length,
//         username: "Ông Hoàng",
//         review: txtReview.value,
//         dateTime: "24/4/2023, 10:12:26",
//         countStar: countStarReview(),
//         img: "./assets/images/pic-6.png"
//     }
//     listReview.unshift(newReview)
//     handleShowListReview(listReview)
//     txtReview.value = ""
// }

// save in db
$(document).ready(function() {
    $("#submit-review").click(function(){
    if(newReview) {
      $.ajax({
        url: "../controller/commentController.php",
        method: "POST",
        data: newReview,
        success: function(data){
          console.log(data);
        }
      });
    }
    else
    {
        $("#list-user-review").css("display","block");
    }
    });
});