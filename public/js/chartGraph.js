/********************************* ********************************/
/******************* Graphique de la page income ******************/
/******************************** *********************************/

// Variables
let canvasTarget = document.getElementById('target');
let targetCTX = canvasTarget.getContext('2d');

let canvasRevenus = document.getElementById('revenus');
let incomeCTX = canvasRevenus.getContext('2d');

const containerRecap = document.querySelectorAll('.containerRecap');
const containerSubject = document.querySelector('.containerSubject');

const revenusIncome = document.querySelector('.revenusIncome');
const revenusHTML =  `<div class="formContainer">
                        <div class="formContentTitle flexCenterCenter">
                            <div class="containerAdd flexCenterCenter">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <h3>CA journalier</h3>
                        </div>
                        <form method="POST" class="flexCenterCenterColumn formIncome">
                            <div class="containerForm flexCenterCenter">
                                <div class="formTask">
                                    <input type="text" placeholder="CA en chiffres*" name="task">
                                </div>
                                <div class="registerButton flexCenterCenter">
                                    <button type="submit"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </form>
                        </div>`;

const targetIncome = document.querySelector('.targetIncome');
const targetHTML = `<div class="formContainer">
                        <div class="formContentTitle flexCenterCenter">
                            <div class="containerAdd flexCenterCenter">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <h3>Objectif</h3>
                        </div>
                        <form method="POST" class="flexCenterCenterColumn formIncome">
                            <div class="containerForm flexCenterCenter">
                                <div class="formTask">
                                    <input type="text" placeholder="Ex: 20000*" name="task">
                                </div>
                                <div class="registerButton flexCenterCenter">
                                    <button type="submit"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>`;

let form = document.querySelector('.formContent');

// Création des graphiques
let chart = new Chart(target, {
    type: 'doughnut',
    data: {
        datasets: [{
            label: 'Revenus',
            data: [1000, 500],
            backgroundColor: [
                'rgba(117, 219, 121, 1)',
                'rgba(227, 231, 247, 1)'
            ],
            borderColor: [
                'rgba(117, 219, 121, 30)',
                'rgba(227, 231, 247, 2)'
            ],
            borderWidth: 1
            
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
    }
});


let chart2 = new Chart(revenus , {
    type: 'bar',
    data: {
        labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
        datasets: [{
            label: 'Chiffre d\'affaires',
            data: [1000, 500, 2000, 1000, 500, 2000, 1000],
            backgroundColor: [
                'rgba(117, 219, 121, 1)',
            ],
            borderColor: [
                'rgba(117, 219, 121, 30)',
            ],
            tension: 0.1,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
    }
});

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
/******************************* WORK *****************************/
/******************************** *********************************/

revenusIncome.addEventListener('click', () => {
    showModal(revenusHTML);
});
targetIncome.addEventListener('click', () => {
    showModal(targetHTML);
});
