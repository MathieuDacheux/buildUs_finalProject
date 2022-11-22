/********************************* ********************************/
/****************** Création du FullCalendar.Js *******************/
/******************************** *********************************/

// Variables
const formContainer = document.querySelector('.formContent');
const eventForm = `<div class="formContainer">
                    <div class="formContentTitle flexCenterCenter">
                        <div class="containerAdd flexCenterCenter">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <h3>Rendez-vous</h3>
                    </div>
                    <form method="POST" class="formAddEvent">
                        <input type="datetime-local" value="" placeholder="CA en chiffres*" name="amount">
                        <input type="number" value="1" name="whichForm" class="hidden">
                        <button type="submit"><i class="fa-solid fa-plus"></i></button>
                    </form>
                </div>`;

/*************************** **************************/
/********************** Functions *********************/
/*************************** **************************/

const showModal = (writeHTML) => {
    calendarEl.style.opacity = '0.5';
    formContainer.classList.remove('hidden');
    formContainer.classList.add('formContentCss');
    formContainer.innerHTML = writeHTML;
    if (document.querySelector('.fa-xmark').addEventListener('click', () => {
        formContainer.classList.add('hidden');
        formContainer.classList.remove('formContentCss');
        calendarEl.style.opacity = '1';
        formContainer.innerHTML = '';
    }));
};

/*************************** **************************/
/************************  Work ***********************/
/*************************** **************************/

// Création d'un calendrier FullCalendar
var calendarEl = document.getElementById('calendar');
var calendar = new FullCalendar.Calendar(calendarEl, {
    editable: true,
    initialView: 'dayGridMonth',
    locale: 'fr',
    buttonText: {
        dayGridMonth: 'Mois',
        timeGridWeek: 'Semaine',
        timeGridDay: 'Jour',
    },
    headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'addEventButton'
    },
    customButtons: {
        addEventButton: {
            text: 'Ajouter',
            click: function() {
                showModal(eventForm);
            }
        }
    },
    events: [
    ]
});

calendar.render()

