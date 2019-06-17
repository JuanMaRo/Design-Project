const menu = document.querySelector('.menu');
const burgerButton = document.querySelector('#burger_menu');

burgerButton.addEventListener('click', hideShow);

function hideShow() {
    if (menu.classList.contains('is_active')) {
        menu.classList.remove('is_active');
    } else {
        menu.classList.add('is_active');
    }
}

const desplegable = document.querySelector('.desplegable');
const spreadButton = document.querySelector('#spread');

spreadButton.addEventListener('click', spreadHide);

function spreadHide() {
    if (desplegable.classList.contains('active')) {
        desplegable.classList.remove('active');
    } else {
        desplegable.classList.add('active');
    }
}