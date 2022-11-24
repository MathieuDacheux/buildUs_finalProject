/********************************* ********************************/
/****************** Graphique de la page main *****************/
/******************************** *********************************/

// Variables
let canvasRevenus = document.getElementById('revenus');
let incomeCTX = canvasRevenus.getContext('2d');

/********************************* ********************************/
/**************************** Functions ***************************/
/******************************** *********************************/

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
    })
