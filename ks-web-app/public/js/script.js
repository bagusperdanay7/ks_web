// Activate Tooltip
const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
);

const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

// Add Toaster
const toastElList = document.querySelectorAll(".toast");
const toastList = [...toastElList].map(
    (toastEl) => new bootstrap.Toast(toastEl, option)
);

const toastTrigger = document.getElementById("liveToastBtn");
const toastLiveExample = document.getElementById("liveToast");

if (toastTrigger) {
    const toastBootstrap =
        bootstrap.Toast.getOrCreateInstance(toastLiveExample);
    toastTrigger.addEventListener("click", () => {
        toastBootstrap.show();
    });
}

//  Add Alert
const alertList = document.querySelectorAll(".alert");
const alerts = [...alertList].map((element) => new bootstrap.Alert(element));

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

const triggerFilter = document.querySelector("#triggerFilter");
const filterGroup = document.querySelector("#filterGroup");

if (triggerFilter !== null) {
    triggerFilter.addEventListener("click", function () {
        if (triggerFilter.textContent == "Show Advanced Filter") {
            triggerFilter.textContent = "Hide Advanced Filter";
        } else {
            triggerFilter.textContent = "Show Advanced Filter";
        }
    });
}

// Show/Hide Password

function passwordToggler(icon, inputType) {
    icon.addEventListener("click", function () {
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
const inputConfirmPass = document.querySelector(".input-confirm-password input");
const oldPasswordIcon = document.querySelector(".old-password-icon");
const inputOldPass = document.querySelector(".input-old-password input");

passwordToggler(passwordIcon, input);
passwordToggler(passwordConfirmIcon, inputConfirmPass);
passwordToggler(oldPasswordIcon, inputOldPass);

// Admin Dashboard
//Button Discover
const searchIcon = document.querySelector(".searchIc");
searchIcon.addEventListener("click", function () {
    window.location.href = "gallery";
});

const hugeProjectTable = document.querySelector("#huge-project");

hugeProjectTable.addEventListener("click", function () {
    hugeProjectTable.classList.add(".active");
});
