// Navbar
function showNav() {
    var element = document.getElementById("side-nav");
    element.classList.toggle('hide');
}

function hideNav() {
    var element = document.getElementById("side-nav");
    element.classList.add('hide');
}

// Filter Projects
filterSelection("all")

function filterSelection(c) {
    var x, i;
    x = document.getElementsByClassName("column");
    if (c == "all") c = "";
    for (i = 0; i < x.length; i++) {
        w3RemoveClass(x[i], "show");
        if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
    }
}

function w3AddClass(element, name) {
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