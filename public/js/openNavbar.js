/*************************** **************************/
/************* Open NavBar in mobile view *************/
/*************************** **************************/

// Variables

const link = document.querySelector('.openModal');
const burger = document.querySelector('.containerBurger');
const ul = document.querySelector('.mobileNavList');

// Function open navbar in mobile view

let openNavMobileView = (e) => {
    e.preventDefault();
    burger.classList.toggle('open');
    ul.classList.toggle('open');
}

/*************************** **************************/
/************************  Work ***********************/
/*************************** **************************/

// On click open navbar in mobile view

link.addEventListener('click', (e) => {
    openNavMobileView(e);
})