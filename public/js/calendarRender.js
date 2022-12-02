/********************************* ********************************/
/****************** Création du FullCalendar.Js *******************/
/******************************** *********************************/

const formContainer = document.querySelector('.formContent');

const showModal = (start, end, allDay) => {
    calendarEl.style.opacity = '0.5';
    formContainer.classList.remove('hidden');
    formContainer.classList.add('formContentCss');
    let date = new Date(start);
    // change le format de la date en d-m-Y
    let dateStart = date.getDate() + '/' + date.getMonth();  
    formContainer.innerHTML = `<div class="formContainer">
                                    <div class="formContentTitle flexCenterCenter">
                                        <div class="containerAdd flexCenterCenter">
                                            <i class="fa-solid fa-xmark"></i>
                                        </div>
                                        <h3>Nouvel événement le ${dateStart}</h3>
                                    </div>
                                    <div class="formAddEvent flexCenterCenterColumn">
                                        <input type="text" name="title" placeholder="Titre de l'événement">
                                        <input type="checkbox" name="allDay" value="${allDay}">
                                        <input type="hidden" name="start" value="${start}">
                                        <div class="containerButton">
                                            <button class="addEventButton">Ajouter</button>
                                        </div>
                                    </div>
                                </div>`;
    if (document.querySelector('input[name="allDay"]').addEventListener('click', () => {
        let allDay = document.querySelector('input[name="allDay"]');
        allDay.value = (allDay.value == 'true') ? 'true' : 'false';
        if (allDay.value)
    }));
    if (document.querySelector('.fa-xmark').addEventListener('click', () => {
        formContainer.classList.add('hidden');
        formContainer.classList.remove('formContentCss');
        calendarEl.style.opacity = '1';
        formContainer.innerHTML = '';
    }));
};

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
    views: {
        timeGrid: {
        dayMaxEventRows: 6 // adjust to 6 only for timeGridWeek/timeGridDay
        }
    },
    headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    selectable: true,
    selectMirror: true,
    dayMaxEventRows: true,
    editable: true,
    dayMaxEvents: true,

    // Create new event in FullDay
    select: function (arg) {
        showModal(arg.start, arg.end, arg.allDay);
        // var title = prompt('Titre de l\'événement:');
        if (document.querySelector('.addEventButton').addEventListener('click', () => {
            const data = {
                title: document.querySelector('input[name="title"]').value,
                start: document.querySelector('input[name="start"]').value,
                end: document.querySelector('input[name="end"]').value,
                allDay: document.querySelector('input[name="allDay"]').value,
                whichForm: 1
            };
            // Put the data into a form and send it
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '';
            for (const name in data) {
                if (data.hasOwnProperty(name)) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = name;
                    input.value = data[name];
                    form.appendChild(input);
                }
            }
            document.body.appendChild(form);
            form.submit();
            calendar.unselect()
        }));
    },
    // Update event when drag and drop
    eventDrop: function (arg) {
        const data = {
            idEvent: arg.event.id,
            start: arg.event.start,
            end: arg.event.end,
            whichForm: 2
        };
        // Put the data into a form and send it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '';
        for (const name in data) {
            if (data.hasOwnProperty(name)) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = data[name];
                form.appendChild(input);
            }
        }
        document.body.appendChild(form);
        form.submit();
    },
    // Delete event
    eventClick: function (arg) {
        if (confirm('Voulez-vous supprimer cet événement ?')) {
            const data = {
                idEvent: arg.event.id,
                whichForm: 3
            };
            // Put the data into a form and send it
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '';
            for (const name in data) {
                if (data.hasOwnProperty(name)) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = name;
                    input.value = data[name];
                    form.appendChild(input);
                }
            }
            document.body.appendChild(form);
            form.submit();
        }
    },
    events: [
        fetch('/helpers/ajax/getEvents.php')
        .then(response => response.json())
        .then(data => {
            data.forEach((item) => {
                if (item.all_day == 1) {
                    calendar.addEvent({
                        title: item.title,
                        start: item.start_at,
                        end: item.end_at,
                        allDay: 'true',
                        id: item.Id_events
                    })
                } else {
                    calendar.addEvent({
                        title: item.title,
                        start: item.start_at,
                        end: item.end_at,
                    })
                }

            })
        })
    ],
});

calendar.render();



