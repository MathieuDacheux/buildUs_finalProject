/********************************* ********************************/
/************* Open modal for add clients / employees *************/
/******************************** *********************************/

// Variables
let formContent = document.querySelector('.containerDeleteSelected');
let confirmationDelete = document.querySelector('.deleteClient');

/*************************** **************************/
/************************  Work ***********************/
/*************************** **************************/

confirmationDelete.addEventListener('click ', () => {
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
});