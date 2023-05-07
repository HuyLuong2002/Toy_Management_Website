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


// modal alert

function addShowModalAlert(icon, title, color, obj) {
    if (obj === undefined) {
        clearTimeout(myTimeOut);
        addRemoveModalAlert();
        setTimeout(function () {
            modalAlert.querySelector('.modal-alert-content .modal-alert-left').innerHTML = `<i class="${icon}></i>`;
            modalAlert.querySelector('.modal-alert-content .modal-alert-right .modal-alert-right-title').innerHTML = title;
            modalAlert.style.backgroundColor = color;
            modalAlert.classList.remove('hide');
            modalAlert.classList.add('show');
            modalProcess.classList.add('active');
            myTimeOut = setTimeout(function () {
                addRemoveModalAlert();
                // console.log("Me end");
            }, 5000);
        }, 300);
        return;
    }

    obj.addEventListener("click", function () {
        clearTimeout(myTimeOut);
        addRemoveModalAlert();
        setTimeout(function () {
            modalAlert.querySelector('.modal-alert-content .modal-alert-left').innerHTML = `<i class="${icon}></i>`;
            modalAlert.querySelector('.modal-alert-content .modal-alert-right .modal-alert-right-title').innerHTML = title;
            modalAlert.style.backgroundColor = color;
            modalAlert.classList.remove('hide');
            modalAlert.classList.add('show');
            modalProcess.classList.add('active');
            myTimeOut = setTimeout(function () {
                addRemoveModalAlert();
                // console.log("Me end");
            }, 5000);
        }, 300);
    })
}

addRemoveModalAlert(modalClose);
function addRemoveModalAlert(obj) {
    if (obj === undefined) {
        modalAlert.classList.remove('show');
        modalAlert.classList.add('hide');
        modalProcess.classList.remove('active');
        return;
    }
    obj.addEventListener('click', function () {
        modalAlert.classList.remove('show');
        modalAlert.classList.add('hide');
        modalProcess.classList.remove('active');
    })
}

function saveEditAction() {

}


