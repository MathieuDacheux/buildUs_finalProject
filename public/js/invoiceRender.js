/********************************* ********************************/
/****************** Graphique de la page business *****************/
/******************************** *********************************/

// Variables
let form = document.querySelector('.formContent');

/********************************* ********************************/
/**************************** Functions ***************************/
/******************************** *********************************/

const showModal = (writeHTML) => {
    containerRecap.forEach((item) => {
        item.style.opacity = '0.5';
    });
    containerSubject.style.opacity = '0.5';
    form.classList.remove('hidden');
    form.innerHTML = writeHTML;
    if (document.querySelector('.fa-xmark').addEventListener('click', () => {
        form.classList.add('hidden');
        containerRecap.forEach((item) => {
            item.style.opacity = '1';
        });
        containerSubject.style.opacity = '1';
        form.innerHTML = '';
    }));
};

/********************************* ********************************/
/**************************** Functions ***************************/
/******************************** *********************************/

fetch('/helpers/ajax/getOneInvoice.php')
    .then(response => response.json())
    .then(data => {
        data.forEach((item) => {
            console.log(item);
        });
    });