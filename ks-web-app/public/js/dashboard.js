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
