// Activate Tooltip
const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
);

const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

// Search Focus "/"
let searchGallery = document.getElementById("searchGallery");
window.addEventListener("keyup", searchKeyFunction, false);

function searchKeyFunction(evt) {
    if (evt.key == "/") {
        searchGallery.focus();
    }
}

// function toggleFilter() {
//     let element = document.getElementById("showFilter");
//     element.classList.toggle("show-visible");
// }
