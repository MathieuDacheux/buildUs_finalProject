/********************************* ********************************/
/************* Open modal for add clients / employees *************/
/******************************** *********************************/

// Variables

const linkUnChecked = document.querySelector('.todosNav');
const linkChecked = document.querySelector('.todosFinished');

const unChecked = document.querySelector('.unChecked');
const checked = document.querySelector('.checked');
let formContent = document.querySelector('.containerDeleteSelected');

let confirmationDelete = document.querySelectorAll('.taskFinished');

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

confirmationDelete.forEach(element => {
    element.addEventListener('click', (e) => {
        if (e.target.classList.contains('taskFinished')) {
            let idTarget = e.target.classList[3];
            let url = `/dashboard/rappels?delete=1&amp;id=${idTarget}`;
            let confirmationContainer = `<div class="containerDelete flexCenterCenterColumn">
                                            <h3>Confirmez la suppression</h3>
                                            <div class="containerLink flexCenterAround">
                                                <a href="${url}">Oui</a>
                                                <a class="closeContainer">Non</a>
                                            </div>
                                        </div>`;
            formContent.innerHTML = confirmationContainer;
            formContent.classList.add('showResult');
            document.querySelector('.closeContainer').addEventListener('click', () => {
                formContent.classList.remove('showResult');
                formContent.innerHTML = '';
            });
        }
    });
});