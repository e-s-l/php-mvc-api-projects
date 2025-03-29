function openModal(id) {
    document.getElementById('modal-' + id).style.display = 'block';
}
function closeModal(id) {
    document.getElementById('modal-' + id).style.display = 'none';
}

document.addEventListener("DOMContentLoaded", function () {
    const modals = document.querySelectorAll(".modal");

    modals.forEach(modal => {
        modal.addEventListener("click", function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    });
});
