let listUserReview = document.getElementById("list-user-review")
let formReview = document.getElementById("wrap-list-reviews")
let btnAddReview = document.getElementById("submit-review")
let txtReview = document.getElementById('review-opinion')
let getAllStar = document.querySelectorAll('.rating .star')
const uri = window.location.href;
const match = uri.match(/id=([^&]*)/);
const idPage = match ? match[1] : null;
const newIdProduct = Number(idPage)

let newReview = {
    product_id: "",
    username: "",
    content: "",
    rate: 0,
    img: ""
}

const fetchAPI = async (api) => {
    return await fetch(api)
        .then(response => response.json())
        .then(data => data)
        .catch(error => console.error(error));
}

let arrStar = [0,0,0,0,0]

const handleLoadListReview = async () => {
    let arr = await fetchAPI(`http://localhost:8000/Toy_Management_Website/api/comment/show.php?productID=${newIdProduct}`)
    if (!arr.comment.length) {
        listUserReview.innerHTML = "<h1>Not found review!</h1>";
        return;
    }

    const UserReview = arr.comment.map((rev, index) => { 
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
                        <span>${rev.time}</span>
                    </div>
                </div>
            </div>
        `;
    }).join('');

    listUserReview.innerHTML = UserReview;
}

const HandleShowListReview = () => {
    console.log("id product:", newIdProduct)
    formReview.style.display = "flex"
    handleLoadListReview()
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

    // listReview.unshift(newReview)
    handleLoadListReview()
    txtReview.value = ""
}

console.log(newReview);

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