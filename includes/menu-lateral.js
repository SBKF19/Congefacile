const toggleButton = document.querySelector(".toggle-button");
const hiddenMenu = document.querySelector(".hidden-menu");

toggleButton.addEventListener("click", Toggle);

function Toggle(){
        if(hiddenMenu.classList.contains("showMenu")){
                hiddenMenu.classList.remove("showMenu");
                hiddenMenu.style.display = "flex";
        } else {
                hiddenMenu.classList.add("showMenu");
                hiddenMenu.style.display = "none";
        }
}