/********************************* ********************************/
/************* Open modal for add clients / employees *************/
/******************************** *********************************/

// Variables

const addBtn = document.querySelector('.fa-plus');
const closeBtn = document.querySelector('.fa-xmark');
const modal = document.querySelector('.formContent');
const mainContainer = document.querySelector('.containerSubject');

// Function open navbar in mobile view

const openModal = () => {
    modal.classList.remove('hidden');
    mainContainer.style.opacity = '0.5';
}

const closeModal = () => {
    modal.classList.add('hidden');
    mainContainer.style.opacity = '1';
}

/*************************** **************************/
/************************  Work ***********************/
/*************************** **************************/

// On click open navbar in mobile view

addBtn.addEventListener('click', () => {
    openModal();
});

closeBtn.addEventListener('click',() => {
    closeModal();
});