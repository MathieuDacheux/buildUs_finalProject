/********************************* ********************************/
/*********** Open modal for delete clients / employees ************/
/******************************** *********************************/

// Variables
let formContent = document.querySelector('.containerDeleteSelected');
const confirmationDelete = document.querySelector('.deleteClient');
const containerRecap = document.querySelector('.containerRecap') ? document.querySelector('.containerRecap') : document.querySelector('.containerForm');
const containerMoreInfo = document.querySelectorAll('.moreInformations');
const idTarget = confirmationDelete.classList[1];

/*************************** **************************/
/************************  Work ***********************/
/*************************** **************************/

confirmationDelete.addEventListener('click', () => {
    containerRecap.style.opacity = '0.5';
    let url = window.location.href.includes('clients') ? `/dashboard/profil-client?id=${idTarget}&amp;delete=true` : `/dashboard/profil-employe?id=${idTarget}&amp;delete=true` ;
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

/*************************** **************************/
/************************  Work ***********************/
/*************************** **************************/

containerMoreInfo.forEach((element) => {
    element.addEventListener('click', () => {
        containerRecap.style.opacity = '0.5';
        let id = element.classList[2];
        let file = element.classList[1];
        let urlSend = `/dashboard/profil-client?id=${id}&amp;file=${file}`;
        let urlDownload = `/public/uploads/${id}/${file}.pdf`;
        let confirmationContainer = `<div class="containerDelete flexCenterCenterColumn">
                                        <div class="containerAdd flexCenterCenter">
                                            <i class="fa-solid fa-xmark closeContainer"></i>
                                        </div>
                                        <div class="containerLinkMore flexCenterCenterColumn">
                                            <a href="${urlDownload}" download>Télécharger</a>
                                            <a href="${urlSend}">Envoyer</a>
                                            <a href="${urlDownload}">Confirmer le paiement</a>
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
});