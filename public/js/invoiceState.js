/********************************* ********************************/
/****************** Graphique de la page business *****************/
/******************************** *********************************/

// Variables
let resultContainer = document.querySelector('.showResult');
const containerContent = document.querySelector('.containerRecap');

/********************************* ********************************/
/**************************** Functions ***************************/
/******************************** *********************************/

const showResult = () => {
    // Recupération du host
    let host = window.location.host;
    // Verifie si le href contient le mot 'client' ou 'employe'
    let who = window.location.href.includes('client') ? 'client' : 'employe';
    // Récupération de la premiere variable get
    let idTarget = window.location.href.split('?')[1].split('&')[0].split('=')[1];
    containerContent.style.opacity = '0.5';
    setTimeout(() => {
        containerContent.style.opacity = '1';
        window.location.href = `http://${host}/dashboard/profil-${who}?id=${idTarget}`;
    }, 1000);
};

/********************************* ********************************/
/****************************** Work ******************************/
/******************************** *********************************/

if (resultContainer) {
    showResult();
}