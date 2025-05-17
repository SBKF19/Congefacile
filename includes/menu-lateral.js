const toggleButton = document.querySelector(".toggle-button");
const hiddenMenu = document.querySelector(".hidden-menu");

// Appliquer l'état sauvegardé au chargement de la page
window.addEventListener("DOMContentLoaded", () => {
        const menuState = localStorage.getItem("menuState");
        if (menuState === "open") {
                hiddenMenu.classList.add("showMenu");
                hiddenMenu.style.display = "flex";
        } else {
                hiddenMenu.classList.remove("showMenu");
                hiddenMenu.style.display = "none";
        }
});

toggleButton.addEventListener("click", Toggle);
function Toggle() {
        if (hiddenMenu.classList.contains("showMenu")) {
                hiddenMenu.classList.remove("showMenu");
                hiddenMenu.style.display = "none";
                localStorage.setItem("menuState", "closed");
        } else {
                hiddenMenu.classList.add("showMenu");
                hiddenMenu.style.display = "flex";
                localStorage.setItem("menuState", "open");
        }
}
