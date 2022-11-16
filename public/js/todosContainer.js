/********************************* ********************************/
/************* Open modal for add clients / employees *************/
/******************************** *********************************/

// Variables

const linkUnChecked = document.querySelector('.todosNav');
const linkChecked = document.querySelector('.todosFinished');

const unChecked = document.querySelector('.unChecked');
const checked = document.querySelector('.checked');

/*************************** **************************/
/************************  Work ***********************/
/*************************** **************************/

linkUnChecked.addEventListener('click', () => {
    checked.classList.add('hidden');
    unChecked.classList.remove('hidden');
});

linkChecked.addEventListener('click', () => {
    checked.classList.remove('hidden');
    unChecked.classList.add('hidden');
});
