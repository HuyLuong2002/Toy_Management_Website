var btn_delete_cancel = document.getElementById(`delete-btn-cancel`);
var bg_modal_box = document.querySelector(".bg-modal-box");
var modal_delete = document.querySelector(`.modal-container-delete`);

// Modal Delete start
function closeCURDDeleteModal() {
    modal_delete.classList.remove("active");
    bg_modal_box.classList.remove("active");
}

function openCURDDeleteModal() {
    modal_delete.classList.add("active");
    bg_modal_box.classList.add("active");
}

var DeleteActive = (id) => {
    let btn_delete = document.getElementById(`action-btn-delete-${id}`);
    btn_delete.addEventListener("click", function () {
        openCURDDeleteModal();
    });
}

var cancelDeleteModal = () => {
    btn_delete_cancel.addEventListener("click", function () {
        closeCURDDeleteModal();
    });
}
// modal delete end

bg_modal_box.addEventListener("click", function (event) {
    // Kiểm tra xem sự kiện click có xảy ra bên ngoài cửa sổ popup hay không
    if (event.target === bg_modal_box) {
        // Nếu có, đóng cửa sổ popup
        closeCURDDeleteModal();
    }
});