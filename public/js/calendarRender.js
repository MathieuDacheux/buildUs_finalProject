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
                        <input type="datetime-local" name="event">
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
        fetch('/calendar')
        .then(response => response.json())
        .then(data => {
            data.forEach(element => {
                calendar.addEvent({
                    title: element.amount,
                    start: element.date,
                    allDay: true,
                    backgroundColor: '#2d2d2d',
                    borderColor: '#2d2d2d',
                    textColor: '#fff'
                });
            });
        })
    ],
});

calendar.render()

