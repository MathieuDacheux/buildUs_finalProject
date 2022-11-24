/********************************* ********************************/
/*********** Open modal for delete clients / employees ************/
/******************************** *********************************/

// Variables
let formContent = document.querySelector('.containerDeleteSelected');
const confirmationDelete = document.querySelector('.deleteClient');
const containerRecap = document.querySelector('.containerForm');

/*************************** **************************/
/************************  Work ***********************/
/*************************** **************************/

confirmationDelete.addEventListener('click', () => {
    containerRecap.style.opacity = '0.5';
    let url = `/dashboard/parametres?delete=true`;
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
        containerRecap.style.opacity = '1';
    });
});