// On Load
var loading;

function onLoad() {
    loading = setTimeout(showPage, 3000);
}

function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("all").style.display = "block";
}

// Navbar
function showNav() {
    var element = document.getElementById("side-nav");
    element.classList.toggle('hide');
}

function hideNav() {
    var element = document.getElementById("side-nav");
    element.classList.add('hide');
}

// Hide Navbar on scroll
var prevScrollpos = window.pageYOffset;
window.onscroll = function () {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbar").style.top = "0";
    } else {
        document.getElementById("navbar").style.top = "-100px";
    }
    prevScrollpos = currentScrollPos;
}

// Filter Projects
filterSelection("all")

function filterSelection(c) {
    var x, i;
    x = document.getElementsByClassName("column");
    if (c == "all") c = "";
    for (i = 0; i < x.length; i++) {
        w3RemoveClass(x[i], "show");
        if (x[i].className.indexOf(c) > -1) toAddClass(x[i], "show");
    }
}

function toAddClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
        if (arr1.indexOf(arr2[i]) == -1) {
            element.className += " " + arr2[i];
        }
    }
}

function w3RemoveClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
        while (arr1.indexOf(arr2[i]) > -1) {
            arr1.splice(arr1.indexOf(arr2[i]), 1);
        }
    }
    element.className = arr1.join(" ");
}

var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function () {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
    });
}

function fetch_images(i) {
    let profile = ["img/people1.jpg", "img/people2.jpg", "img/cars1.jpg", "img/mountains.jpg", "img/cars3.jpg", "img/lights.jpg", "img/cars2.jpg", "img/nature.jpg"];
    document.getElementById("imageID").src = profile[i];
}


// Team Section
function fetch_info(i) {
    let name = ["Enes Shala", "Xhelal Jashari", "Ermal Muhaxheri", "Fitim Bytyci"];
    document.getElementById("userInfo").innerHTML = name[i] + " molestie malesuada. Curabitur aliquet quam id dui posuere blandit. Nulla porttitor accumsan tincidunt. Quisque velit nisi, pretium ut lacinia in, elemena porttitor accumsan tincidunt. Quisque velit nisi, pretium ut lacinia in,  lementum id enim. Vestibulum ac diam sit anet. <br /> Oitudin molestie malesuada. Curabitur aliquet quam id dui posuere blandit. Nulla porttitor ccumsan tincidunt. Quisque velit nisi, pretium ut lacinia in, elemena porttitor accumsan tinci dunt. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Vestibulum ac diam sit anet.";
    document.getElementById("userTitle").innerHTML = name[i] + " - My Story";
}


// Carousel
document.getElementById("outer3").addEventListener("click", toggleState3);

function toggleState3() {
    let galleryView = document.getElementById("galleryView")
    let tilesView = document.getElementById("tilesView")
    let outer = document.getElementById("outer3");
    let slider = document.getElementById("slider3");
    let tilesContainer = document.getElementById("tilesContainer");
    if (slider.classList.contains("active")) {
        slider.classList.remove("active");
        outer.classList.remove("outerActive");
        galleryView.style.display = "flex";
        tilesView.style.display = "none";

        while (tilesContainer.hasChildNodes()) {
            tilesContainer.removeChild(tilesContainer.firstChild)
        }
    } else {
        slider.classList.add("active");
        outer.classList.add("outerActive");
        galleryView.style.display = "none";
        tilesView.style.display = "flex";

        for (let i = 0; i < imgObject.length - 1; i++) {
            let tileItem = document.createElement("div");
            tileItem.classList.add("tileItem");
            tileItem.style.background = "url(" + imgObject[i] + ")";
            tileItem.style.backgroundSize = "contain";
            tilesContainer.appendChild(tileItem);
        }
    };
}

let imgObject = [
    "https://placeimg.com/450/450/any",
    "https://placeimg.com/450/450/animals",
    "https://placeimg.com/450/450/architecture",
    "https://placeimg.com/450/450/nature",
    "https://placeimg.com/450/450/people",
    "https://placeimg.com/450/450/tech",
    "https://picsum.photos/id/1/450/450",
    "https://picsum.photos/id/8/450/450",
    "https://picsum.photos/id/12/450/450",
    "https://picsum.photos/id/15/450/450",
    "https://picsum.photos/id/5/450/450",
];

let mainImg = 0;
let prevImg = imgObject.length - 1;
let nextImg = 1;

function loadGallery() {

    let mainView = document.getElementById("mainView");
    mainView.style.background = "url(" + imgObject[mainImg] + ")";

    let leftView = document.getElementById("leftView");
    leftView.style.background = "url(" + imgObject[prevImg] + ")";

    let rightView = document.getElementById("rightView");
    rightView.style.background = "url(" + imgObject[nextImg] + ")";

    let linkTag = document.getElementById("linkTag")
    linkTag.href = imgObject[mainImg];

};

function scrollRight() {

    prevImg = mainImg;
    mainImg = nextImg;
    if (nextImg >= (imgObject.length - 1)) {
        nextImg = 0;
    } else {
        nextImg++;
    };
    loadGallery();
};

function scrollLeft() {
    nextImg = mainImg
    mainImg = prevImg;

    if (prevImg === 0) {
        prevImg = imgObject.length - 1;
    } else {
        prevImg--;
    };
    loadGallery();
};

document.getElementById("navRight").addEventListener("click", scrollRight);
document.getElementById("navLeft").addEventListener("click", scrollLeft);
document.getElementById("rightView").addEventListener("click", scrollRight);
document.getElementById("leftView").addEventListener("click", scrollLeft);
document.addEventListener('keyup', function (e) {
    if (e.keyCode === 37) {
        scrollLeft();
    } else if (e.keyCode === 39) {
        scrollRight();
    }
});

loadGallery();
