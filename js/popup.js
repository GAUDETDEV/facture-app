let btn1 = document.querySelector(".btn1")
let popup = document.querySelector('.popup')

function afficherPopupModification(){
    let popupOverlay = document.getElementById("popup-overlay")
    popupOverlay.classList.add("open")
}

function cacherPopupModification(){
    let popupOverlay = document.getElementById("popup-overlay")
    popupOverlay.classList.remove("open")
}

btn1.addEventListener('click', () =>{

    afficherPopupModification()

})

popup.addEventListener("click", (event) => {
    if(event.target === popup){
        cacherPopupModification()
    }
})
