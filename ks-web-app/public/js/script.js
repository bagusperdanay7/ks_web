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

const mobileMenu = document.getElementById("mobile-menu");
const menuBtnMobile = document.getElementById("menu-btn-mobile");

function mobileMenuFunc() {
    mobileMenu.classList.toggle("show-mobile-menu");
}

menuBtnMobile.addEventListener("click", mobileMenuFunc, true);

// Show/Hide Password

function passwordToggler(icon, inputType) {
    icon.addEventListener("click", () => {
        if (inputType.type === "password") {
            inputType.type = "text";

            icon.classList.remove("la-eye");
            icon.classList.add("la-eye-slash");
        } else {
            inputType.type = "password";

            icon.classList.remove("la-eye-slash");
            icon.classList.add("la-eye");
        }
    });
}

// Call Password Toggler
const passwordIcon = document.querySelector(".password-icon");
const input = document.querySelector(".input-password input");
const passwordConfirmIcon = document.querySelector(".password-confirm-icon");
const inputConfirmPass = document.querySelector(
    ".input-confirm-password input"
);

passwordToggler(passwordIcon, input);
passwordToggler(passwordConfirmIcon, inputConfirmPass);
