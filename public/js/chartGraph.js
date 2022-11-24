/********************************* ********************************/
/****************** Graphique de la page business *****************/
/******************************** *********************************/

// Variables
let canvasTarget = document.getElementById('target');
let targetCTX = canvasTarget.getContext('2d');

let canvasRevenus = document.getElementById('revenus');
let incomeCTX = canvasRevenus.getContext('2d');

const containerRecap = document.querySelectorAll('.containerRecap');
const containerSubject = document.querySelector('.containerSubject');

const iconRevenue = document.querySelector('.revenusIncome');
const iconTarget = document.querySelector('.targetIncome');

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

// Affichage du dernier revenus enregistré dans le formulaire en Ajax
fetch('/helpers/ajax/getLastIncome.php')
    .then(response => response.json())
    .then(data => {
        let income = data.daily_income;
        let dateLastIncome = data.income_date;

        // Changement du format de la date reçu en d-m-Y
        let date = new Date(dateLastIncome);
        let dateLastIncomeFormat = date.getDate() + '-' + date.getMonth() + 1 + '-' + date.getFullYear();

        // Récupération de la date du jour en d-m-Y
        let currentDate = new Date();
        let currentDateFormat = currentDate.getDate() + '-' + currentDate.getMonth() + 1 + '-' + currentDate.getFullYear();

        // Si la date du dernier revenus enregistré est la même que la date du jour alors on affiche le revenus dans le formulaire
        let valueIncome  = (dateLastIncomeFormat === currentDateFormat) ? income : '';
        let iconAdd = (valueIncome != '' ? 'fa-solid fa-pen' : 'fa-solid fa-plus');

        iconRevenue.innerHTML = `<i class="${iconAdd}"></i>`;
        
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
                                            <input type="number" value="${valueIncome}" placeholder="CA en chiffres*" name="amount">
                                        </div>
                                        <input type="number" value="1" name="whichForm" class="hidden">
                                        <div class="registerButton flexCenterCenter">
                                            <button type="submit"><i class="${iconAdd}"></i></button>
                                        </div>
                                    </div>
                                </form>
                                </div>`;

        revenusIncome.addEventListener('click', () => {
            showModal(revenusHTML);
        });
})

// Utilisation de Chart.js pour afficher le graphique des revenus des 7 derniers jours
fetch ('/helpers/ajax/getSevenDays.php')
    .then(response => response.json())
    .then(data => {
        
        // Tableau recevant les revenus des 7 derniers jours
        let datasetRevenus = [];
        // Variable contenant la somme des revenus des 7 derniers jours
        let totalRevenus = 0;
        let targetRevenus = 0;
        // Tableau recevant l'objectif est le total des revenus des 7 derniers jours
        let datasetTarget = [];

        // Tableau recevant les jours de la semaine qui servira de label
        const daysOfWeek = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];

        // Tableau des jours de la semaine en valeur numérique
        const daysInNumber = [1, 2, 3, 4, 5, 6, 7];
        
        // Dataset reçoit les revenus des 7 derniers indexés par les jours de la semaine en valeur numérique
        data.forEach(element => {
            let date = new Date(element.income_date);
            let day = (date.getDay() != 0) ? date.getDay() : 7;
            let revenus = parseInt(element.daily_income);
            totalRevenus += revenus;
            targetRevenus = parseInt(element.target);
            console.log(targetRevenus);
            if (daysInNumber.includes(day)) {
                datasetRevenus[day - 1] = element.daily_income;
            } else {
                datasetRevenus[day - 1] = 0;
            }
        });
        let targetCondition = ((targetRevenus - totalRevenus) > 0) ? targetRevenus - totalRevenus : 0;
        // Ajout de l'objectif et du total des revenus dans le dataset
        datasetTarget.push(targetCondition, totalRevenus);

        // Création du graphique des revenus des 7 derniers jours
        new Chart(revenus , {
            type: 'bar',
            data: {
                labels: daysOfWeek,
                datasets: [{
                    label: 'Chiffre d\'affaires',
                    data: datasetRevenus,
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

        // Création du graphique objectif hebdomadaire
        new Chart(target, {
            type: 'doughnut',
            data: {
                datasets: [{
                    label: 'Revenus',
                    data: datasetTarget,
                    backgroundColor: [
                        'rgba(227, 231, 247, 1)',
                        'rgba(117, 219, 121, 1)'
                    ],
                    borderColor: [
                        'rgba(227, 231, 247, 30)',
                        'rgba(117, 219, 121, 30)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

    // Si l'objectif hebdomadaire est égale à 0 alors la value est vide sinon elle est égale à l'objectif
    let valueTarget  = (targetRevenus != 0) ? targetRevenus : '';
    let iconAdd = (valueTarget != '' ? 'fa-solid fa-pen' : 'fa-solid fa-plus');

    iconTarget.innerHTML = `<i class="${iconAdd}"></i>`;
    
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
                                <input type="number" value="${valueTarget}" placeholder="Ex: 20000*" name="target">
                            </div>
                            <input type="number" value="2" name="whichForm" class="hidden">
                            <div class="registerButton flexCenterCenter">
                                <button type="submit"><i class="${iconAdd}"></i></button>
                            </div>
                        </div>
                    </form>
                </div>`;

        targetIncome.addEventListener('click', () => {
            showModal(targetHTML);
        });
    })
