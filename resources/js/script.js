console.log("test");

const burgerBtn = document.getElementById("burger-bnt");
const closeMenuBtn = document.getElementById("menu-close");
const sideBar = document.getElementById("sidebar");

if (burgerBtn) {
    burgerBtn.addEventListener("click", function (e) {
        sideBar.classList.toggle("ml-[-100%]");
    });
}
if (closeMenuBtn) {
    closeMenuBtn.addEventListener("click", function (e) {
        sideBar.classList.toggle("ml-[-100%]");
    });
}
