// Search Focus "/"
let searchGallery = document.getElementById("searchGallery");
window.addEventListener("keyup", searchKeyFunction, false);

function searchKeyFunction(evt) {
    if (evt.key == "/") {
        searchGallery.focus();
    }
}

function toggleFilter() {
    let element = document.getElementById("showFilter");
    element.classList.toggle("show-visible");
}

const mobileMenu = document.querySelector("#mobile-menu");
const menuBtnMobile = document.querySelector("#menu-btn-mobile");

menuBtnMobile.addEventListener("click", function () {
    mobileMenu.classList.toggle("show-mobile-menu");
});

// klik di luar hamburger
document.addEventListener("click", function (e) {
    if (e.target != menuBtnMobile && e.target != mobileMenu) {
        mobileMenu.classList.remove("show-mobile-menu");
    }
});

const triggerFilter = document.querySelector("#triggerFilter");
const filterGroup = document.querySelector("#filterGroup");

if (triggerFilter !== null) {
    triggerFilter.addEventListener("click", function () {
        if (triggerFilter.textContent.includes("Hide")) {
            triggerFilter.innerHTML = "Show Advanced Filter";
        } else if (triggerFilter.textContent.includes("Show")) {
            triggerFilter.innerHTML = "Hide Advanced Filter";
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
const inputConfirmPass = document.querySelector(
    ".input-confirm-password input"
);
const oldPasswordIcon = document.querySelector(".old-password-icon");
const inputOldPass = document.querySelector(".input-old-password input");

if (passwordIcon !== null) {
    passwordToggler(passwordIcon, input);
}

if (passwordConfirmIcon !== null) {
    passwordToggler(passwordConfirmIcon, inputConfirmPass);
}

if (oldPasswordIcon !== null) {
    passwordToggler(oldPasswordIcon, inputOldPass);
}

const copyrightYear = document.querySelector("#copyright-year");
copyrightYear.innerHTML = new Date().getFullYear();

// const themeSwitcherMobile = document.querySelector("#theme-switcher-mobile");
// const themeSwitcher = document.querySelector("#theme-switcher");
// const html = document.querySelector("html");

// Bootstrap Dark Theme

// if (themeSwitcherMobile !== null) {
//     themeSwitcherMobile.addEventListener("click", function () {
//         if (
//             localStorage.dataTheme == "light" &&
//             localStorage.dataBsTheme == "light"
//         ) {
//             html.setAttribute("data-theme", "dark");
//             html.setAttribute("data-bs-theme", "dark");
//             localStorage.dataTheme = "dark";
//             localStorage.dataBsTheme = "dark";
//         } else {
//             html.setAttribute("data-theme", "light");
//             html.setAttribute("data-bs-theme", "light");
//             localStorage.dataTheme = "light";
//             localStorage.dataBsTheme = "light";
//         }
//     });
// }

// if (themeSwitcher !== null) {
//     themeSwitcher.addEventListener("click", function () {
//         if (
//             localStorage.dataTheme == "light" &&
//             localStorage.dataBsTheme == "light"
//         ) {
//             html.setAttribute("data-theme", "dark");
//             html.setAttribute("data-bs-theme", "dark");
//             localStorage.dataTheme = "dark";
//             localStorage.dataBsTheme = "dark";
//         } else {
//             html.setAttribute("data-theme", "light");
//             html.setAttribute("data-bs-theme", "light");
//             localStorage.dataTheme = "light";
//             localStorage.dataBsTheme = "light";
//         }
//     });
// }
