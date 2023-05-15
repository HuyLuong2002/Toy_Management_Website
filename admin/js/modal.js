var btn_delete_cancel = document.getElementById(`delete-btn-cancel`);
var bg_modal_box = document.querySelector(".bg-modal-box");
var modal_delete = document.querySelector(`.modal-container-delete`);
var modal_edit = document.querySelector(`.modal-container-edit`);
var modal_add = document.querySelector(`.modal-container-add`);
var close_edit_modal = document.querySelector(".modal-container-edit-close span");
var close_add_modal = document.querySelector(".modal-container-add-close span");

const modalAlert = document.querySelector('.modal-alert');
const modalClose = document.querySelector('.modal-alert-close');
const modalProcess = document.querySelector('.modal-alert-process');

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

//modal edit start
function openCURDEditModal() {
    modal_edit.classList.add("active");
    bg_modal_box.classList.add("active");
}

function closeCURDEditModal() {
    modal_edit.classList.remove("active");
    bg_modal_box.classList.remove("active");
}

var EditActive = (id) => {
    let btn_edit = document.getElementById(`action-btn-edit-${id}`);
    btn_edit.addEventListener("click", function () {
        openCURDEditModal();
    });
}

var closeCurdEditModal = () => {
    close_edit_modal.addEventListener("click", function () {
        closeCURDEditModal();
    });
}

// modal edit end

// modal add start
function openCURDAddModal() {
    modal_add.classList.add("active");
    bg_modal_box.classList.add("active");
}

function closeCURDAddModal() {
    modal_add.classList.remove("active");
    bg_modal_box.classList.remove("active");
}

var AddActive = () => {
    let btn_add = document.querySelector('.modal-btn-add');
    btn_add.addEventListener("click", function () {
        openCURDAddModal();
    });
}

var closeCurdAddModal = () => {
    close_add_modal.addEventListener("click", function () {
        closeCURDAddModal();
    });
}

//modal add end

bg_modal_box.addEventListener("click", function (event) {
    // Kiểm tra xem sự kiện click có xảy ra bên ngoài cửa sổ popup hay không
    if (event.target === bg_modal_box) {
        // Nếu có, đóng cửa sổ popup
        // modal.style.display = "none";
        closeCURDAddModal();
        closeCURDDeleteModal();
        closeCURDEditModal();
    }
});



