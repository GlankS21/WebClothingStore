
// --------------------------Menu-Navigation---------------------------------------
const header = document.querySelector("header")
window.addEventListener("scroll", function(){
    x = window.pageYOffset
    if(x > 0){
        header.classList.add("active")
    }else{
        header.classList.remove("active")
    }
})
const imgPosition = document.querySelectorAll(".aspect-ratio-169 img")
const imgContainer = document.querySelector('.aspect-ratio-169')
const dotItem = document.querySelectorAll(".dot")
let imgNumber = imgPosition.length
let index = 0
imgPosition.forEach(function(image,index){
    image.style.left = index * 100 + "%"
    dotItem[index].addEventListener("click", function(){
        slider(index)
    })
})
// --------------------------Menu-Slider---------------------------------------
function imgSlide(){
    index++;
    if(index >= imgNumber) {index = 0}
    slider(index)
}
function slider(index){
    imgContainer.style.left = "-" + index*100 + "%"
    const dotActive = document.querySelector(".active")
    dotActive.classList.remove("active")
    dotItem[index].classList.add("active")
}
setInterval(imgSlide, 5000);
// --------------------------Menu-Sliderbar-Cartegory---------------------------------------
const itemsliderbar = document.querySelectorAll(".cartegory-left-li");
itemsliderbar.forEach(function(menu, index) {
    menu.addEventListener("click", function() {
        if (menu.classList.contains("block")) { 
            menu.classList.remove("block")
        } else {
            menu.classList.add("block")
        }
    });
});
// -----------------------------Product--------------------------------------------
const bigImg = document.querySelector(".product-content-left-big-img img")
const smallImg = document.querySelectorAll(".product-content-left-small-img img")
smallImg.forEach(function(imgItem,X){
    imgItem.addEventListener("click", function(){
        bigImg.src = imgItem.src
    })
})
// Information
const baoquan = document.querySelector(".baoquan");
const chitiet = document.querySelector(".chitiet");
const chitietContent = document.querySelector(".product-content-right-bottom-content-chitiet");
const baoquanContent = document.querySelector(".product-content-right-bottom-content-baoquan");
const btn = document.querySelector(".product-content-right-bottom-top");
const bigContent = document.querySelector(".product-content-right-bottom-content-big");
function switchTab(showElement, hideElement, activeButton, inactiveButton) {
    if (showElement && hideElement) {
        showElement.style.display = "block";
        hideElement.style.display = "none";
    }
    if (activeButton && inactiveButton) {
        activeButton.classList.add("activeInfBtn");
        inactiveButton.classList.remove("activeInfBtn");
    }
}
if (baoquan && chitiet) {
    baoquan.addEventListener("click", function() {
        switchTab(baoquanContent, chitietContent, baoquan, chitiet);
    });
    chitiet.addEventListener("click", function() {
        switchTab(chitietContent, baoquanContent, chitiet, baoquan);
    });
}
if (btn && bigContent) {
    btn.addEventListener("click", function() {
        bigContent.classList.toggle("activeBtn");
    });
}

// -------------
const about = document.querySelector(".about");
const contacts = document.querySelector(".contacts");
const aboutContent = document.querySelector(".about-content-about");
const contactsContent = document.querySelector(".about-content-contacts");
function switchTab(showElement, hideElement, activeButton, inactiveButton) {
    if (showElement && hideElement) {
        showElement.style.display = "block";
        hideElement.style.display = "none";
    }
    if (activeButton && inactiveButton) {
        activeButton.classList.add("active_InfBtn");
        inactiveButton.classList.remove("active_InfBtn");
    }
}
if (about && contacts) {
    about.addEventListener("click", function() {
        switchTab(aboutContent, contactsContent, about, contacts);
    });
    contacts.addEventListener("click", function() {
        switchTab(contactsContent, aboutContent, contacts, about);
    });
}
