let formReview = document.getElementById("wrap-list-reviews")
let listUserReview = document.getElementById("list-user-review")
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
    // let arr = await fetchAPI(`http://localhost:3000/api/comment/show.php?productID=${newIdProduct}`)
    let arr = await fetchAPI(`http://localhost:8080/Toy_Management_Website/api/comment/show.php?productID=${newIdProduct}`)
    // let arr = await fetchAPI(`http://localhost:8000/Toy_Management_Website/api/comment/show.php?productID=${newIdProduct}`)
    if (!arr) {
        listUserReview.innerHTML = "<h1>Not found review!</h1>";
        return;
    }

    const UserReview = arr.comment.map((rev, index) => { 
        let flag = 0
        return `
            <div class="use-review" key="${index}">
                <img src=${rev.img ? rev.img : "./assets/images/user.png"} alt="avatar">
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
    formReview.style.display = "flex"
    handleLoadListReview()
}

const handleClose = () => {
    formReview.style.display = "none"
}

window.onclick = (e) => {
    if(e.target == formReview) 
        handleClose()
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
    let apiGetCurrentUser = await fetchAPI(`http://localhost:8080/Toy_Management_Website/api/accounts/show.php?id=${userId}`) 
    // let apiGetCurrentUser = await fetchAPI(`http://localhost:3000/api/accounts/show.php?id=${userId}`) 
    // let apiGetCurrentProduct = await fetchAPI(`http://localhost:8000/Toy_Management_Website/api/product/show.php?id=${productId}`)

    let addSuccess = document.querySelector('.add-success')
    let addFail = document.querySelector('.add-fail')

    newReview = {
        product_id: productId,
        user_id: userId,
        content: txtReview.value,
        rate: countStarReview(),
        img: apiGetCurrentUser.img || "./assets/images/user.png",
    }

    // Lưu đánh giá vào cơ sở dữ liệu
    await $.ajax({
        url: "./controller/listReviewController.php",
        method: "POST",
        data: {review: newReview},
        success: function(data){
            $("#add-success").css("display","block");
            addSuccess.classList.add("hide")

            setTimeout(function() {
                addSuccess.style.display = 'none';
                addSuccess.classList.remove('hide');
            }, 2500);
        },
        error: function(xhr, status, error) {
            $("#add-fail").css("display","block");
            addFail.classList.toggle("hide")

            setTimeout(function() {
                addFail.style.display = 'none';
                addFail.classList.remove('hide');
            }, 2500);

            console.log("Error:", error);
        }
    });

    handleLoadListReview()
    txtReview.value = ""
}




