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

// Admin Dashboard
//Button Discover
const searchIcon = document.querySelector(".searchIc");
searchIcon.addEventListener("click", function () {
    window.location.href = "../index.php";
});

const hugeProjectTable = document.querySelector("#huge-project");

hugeProjectTable.addEventListener("click", function () {
    hugeProjectTable.classList.add(".active");
});

/* globals Chart:false, feather:false */

(function () {
    "use strict";

    feather.replace({ "aria-hidden": "true" });

    // Graphs
    var ctx = document.getElementById("myChart");
    // eslint-disable-next-line no-unused-vars
    var myChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
            ],
            datasets: [
                {
                    data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
                    lineTension: 0,
                    backgroundColor: "transparent",
                    borderColor: "#007bff",
                    borderWidth: 4,
                    pointBackgroundColor: "#007bff",
                },
            ],
        },
        options: {
            scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: false,
                        },
                    },
                ],
            },
            legend: {
                display: false,
            },
        },
    });
})();
