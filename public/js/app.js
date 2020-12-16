'use strict';

let instructiveOptions = document.querySelectorAll("[value='0']");

for (let node of instructiveOptions) {
    node.disabled = true;
    node.classList.add("disabled-option");
}

let navbarElement = document.getElementById('navbar');
let heightOfBackgroundImage = document.documentElement.clientHeight - navbarElement.offsetHeight;
let bg_imageElement = document.getElementById('bg_image');
let bg_imageElement1 = document.getElementById('bg_image1');
let bg_imageElement2 = document.getElementById('bg_image2');
bg_imageElement.style.height = heightOfBackgroundImage + 'px';
bg_imageElement1.style.height = heightOfBackgroundImage + 'px';
bg_imageElement2.style.height = heightOfBackgroundImage + 'px';
bg_imageElement.style.width = document.documentElement.offsetWidth + 'px';
bg_imageElement1.style.width = document.documentElement.offsetWidth + 'px';
bg_imageElement2.style.width = document.documentElement.offsetWidth + 'px';