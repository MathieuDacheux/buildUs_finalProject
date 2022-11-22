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
    containerContent.style.opacity = '0.5';
    setTimeout(() => {
        containerContent.style.opacity = '1';
        // Relocation to the same page
        window.location.href = window.location.href;
    }, 1000);
};

/********************************* ********************************/
/**************************** Functions ***************************/
/******************************** *********************************/

if (resultContainer) {
    showResult();
}