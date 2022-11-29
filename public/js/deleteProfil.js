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
        let file = element.classList[1];
        let id = element.classList[2];
        let state = (element.classList[3] == 0) ? '1' : '0';
        let idPDF = element.classList[4];
        let who = window.location.href.includes('clients') ? 'client' : 'employe' ;
        let linkUpdate = (state == 0) ? 'Annuler le paiement' : 'Confirmer le paiement';
        let urlSend = `/dashboard/profil-${who}?id=${id}&amp;send=${file}`;
        let urlDownload = `/public/uploads/${id}/${file}.pdf`;
        let urlUpdate = `/dashboard/profil-${who}?id=${id}&amp;url=${file}&amp;update=${state}`;
        let urlDelete = `/dashboard/profil-${who}?id=${id}&amp;pdf=${idPDF}`;
        let confirmationContainer = `<div class="containerDelete flexCenterCenterColumn">
                                        <div class="containerAdd flexCenterCenter">
                                            <i class="fa-solid fa-xmark closeContainer"></i>
                                        </div>
                                        <div class="containerLinkMore flexCenterCenterColumn">
                                            <a href="${urlDownload}" download>Télécharger</a>
                                            <a href="${urlSend}">Envoyer par mail</a>
                                            <a href="${urlUpdate}">${linkUpdate}</a>
                                            <a href="${urlDelete}">Supprimer</a>
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