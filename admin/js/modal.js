const DeleteActive = (id) => {
    let btn_delete = document.getElementById(`action-btn-delete-${id}`);
    let btn_delete_cancel = document.getElementById(`delete-btn-cancel-${id}`);
    let modal_delete = document.getElementById(`modal-container-delete-${id}`);
    let bg_modal_box = document.querySelector(".bg-modal-box");
        btn_delete.addEventListener("click", function () {
            modal_delete.classList.add("active");
            bg_modal_box.classList.add("active");
        });

    btn_delete_cancel.addEventListener("click", function () {
        modal_delete.classList.remove("active");
        bg_modal_box.classList.remove("active");
    });
}

