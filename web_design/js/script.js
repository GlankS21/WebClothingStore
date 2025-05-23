
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
document.querySelectorAll('.menu-mb > li').forEach(li => {
    const hasSub = li.querySelector('.sub-menu-mb');
    if (hasSub) {
        li.classList.add('has-submenu');
        li.querySelector('a').addEventListener('click', function(e) {
            e.preventDefault();
            li.classList.toggle('open');
        });
    }
});
document.querySelectorAll('.footer-center-header > li').forEach(li => {
    const hasSubFooter = li.querySelector('.sub-footer-center');
    if (hasSubFooter) {
        li.classList.add('has-subfooter');
        li.querySelector('a').addEventListener('click', function(e) {
            e.preventDefault();
            li.classList.toggle('open');
        });
    }
});
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
// --------------------------Filter-Cartegory----------------------------------
document.addEventListener("DOMContentLoaded", function () {
    const items = document.querySelectorAll(".item-side-title");

    items.forEach(function (itemTitle) {
        const parentItem = itemTitle.closest(".item-side");
        const plusIcon = itemTitle.querySelector(".icon-plus");
        const minusIcon = itemTitle.querySelector(".icon-minus");
        const subList = parentItem.querySelector(".sub-list-side");

        itemTitle.addEventListener("click", function () {
            const isVisible = subList.style.display === "flex";
            if (isVisible) {
                subList.style.display = "none";
                minusIcon.style.display = "none";
                plusIcon.style.display = "inline";
            } else {
                subList.style.display = "flex";
                plusIcon.style.display = "none";
                minusIcon.style.display = "inline";
            }
        });
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
const aboutContentTitle = document.querySelector(".information-content-about-title");
const contactsContentTitle = document.querySelector(".information-content-contacts-title");
const aboutContent = document.querySelector(".information-content-about");
const contactsContent = document.querySelector(".information-content-contacts");
function switchTab_About(showElementTitle, hideElementTitle, showElement, hideElement, activeButton, inactiveButton) {
    if (showElementTitle && hideElementTitle) {
        showElementTitle.style.display = "block";
        hideElementTitle.style.display = "none";
    }
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
    about.addEventListener("click", () => {
        switchTab_About(aboutContentTitle, contactsContentTitle, aboutContent, contactsContent, about, contacts);
    });
    contacts.addEventListener("click", () => {
        switchTab_About(contactsContentTitle, aboutContentTitle, contactsContent, aboutContent, contacts, about);
    });
}
// ----------------Mobie -----------------------------
const mobileMenu = document.querySelector('.mobile-menu');
const subMobileMenu = document.querySelector('.sub-mobile-menu');
mobileMenu.addEventListener('click', function() {
    this.classList.toggle('active');
    if (this.classList.contains('active')) { subMobileMenu.style.display = 'block';
    } else { subMobileMenu.style.display = 'none';
    }
});

// ---------------Select size-----------
document.querySelectorAll('.size span').forEach(function(size) {
    size.addEventListener('click', function() {
        document.querySelectorAll('.size span').forEach(function(span) {
            span.classList.remove('selected');
        });
        this.classList.add('selected');
    });
});
