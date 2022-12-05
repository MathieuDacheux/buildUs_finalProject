/********************************* ********************************/
/****************** Création du FullCalendar.Js *******************/
/******************************** *********************************/

const formContainer = document.querySelector('.formContent');

const showModalInput = (start, end) => {
    calendarEl.style.opacity = '0.5';
    formContainer.classList.remove('hidden');
    formContainer.classList.add('formContentCss');
    // Changement du format de date
    let date = new Date(start);
    // Changement de la date en dd/mm/yyyy
    let dateTitle = date.getDate() + '/' + (date.getMonth()) + '/' + date.getFullYear();
    // Changement du format de date pour qu'il soit compatible avec datetime-local
    let dateStart = new Date(date.setDate(date.getDate() + 1)).toISOString().slice(0, 10) + 'T08:00';
    // Changement du format de date
    date = new Date(end);
    // Changement du format de date pour qu'il soit compatible avec datetime-local
    let dateEnd = date.toISOString().slice(0, 10) + 'T17:00';
    formContainer.innerHTML = `<div class="formContainer">
                                    <div class="formContentTitle flexCenterCenter">
                                        <h4>Nouvel événement le ${dateTitle}</h4>
                                    </div>
                                    <div class="formAddEvent flexCenterCenterColumn">
                                        <div class="containerInput flexCenterCenter">
                                            <label for="allDay">Journée entière :</label>
                                            <input type="checkbox" name="allDay" id="allDay" value="false">
                                        </div>
                                        <div class="containerInput flexCenterCenterColumn">
                                            <label for="title" class="titleLabel">Titre de l'événement :</label>
                                            <input type="text" name="title">
                                        </div>
                                        <div class="containerInputDate flexCenterCenterColumn">
                                            <label for="start" class="titleLabel">Début :</label>
                                            <input type="datetime-local" name="start" value="${dateStart}">
                                        </div>
                                        <div class="containerInputDate flexCenterCenterColumn">
                                            <label for="end" class="titleLabel">Fin :</label>
                                            <input type="datetime-local" name="end" value="${dateEnd}">
                                        </div>
                                    </div>
                                    <div class="containerButton">
                                        <button class="addEventButton">Ajouter</button>
                                        <button class="cancelButton">Annuler</button>
                                    </div>
                                </div>`;
    const allDayCheckbox = document.querySelector('#allDay');
    const containerInputDate = document.querySelectorAll('.containerInputDate');
    allDayCheckbox.addEventListener('change', () => {
        if (allDayCheckbox.checked) {
            allDayCheckbox.value = 'true';
            containerInputDate.forEach((container) => {
                container.children[1].setAttribute('disabled', 'disabled'); 
            });
            // Change the value inside the input
            containerInputDate[0].children[1].value = dateStart.slice(0, 10) + 'T00:00';
            containerInputDate[1].children[1].value = dateEnd.slice(0, 10) + 'T23:59';
        } else {
            allDayCheckbox.value = 'false';
            containerInputDate.forEach((container) => {
                container.children[1].removeAttribute('disabled');
            });
            // Change the value inside the input
            containerInputDate[0].children[1].value = dateStart;
            containerInputDate[1].children[1].value = dateEnd;
        }
    });
    const cancelButton = document.querySelector('.cancelButton');
    cancelButton.addEventListener('click', () => {
        formContainer.classList.add('hidden');
        formContainer.classList.remove('formContentCss');
        formContainer.innerHTML = '';
        calendarEl.style.opacity = '1';
    });
};

const showModalRead = (start, end, title, allDay) => {
    calendarEl.style.opacity = '0.5';
    formContainer.classList.remove('hidden');
    formContainer.classList.add('formContentCss');
    // Changement du format de date
    let dateTimeStart = new Date(start);
    // Changement du format de date pour datetime-local
    let dateInputStart = new Date(dateTimeStart.setDate(dateTimeStart.getDate() + 1)).toISOString().slice(0, 10) + 'T' + dateTimeStart.toTimeString().slice(0, 5);
    // Changement du format de date
    let dateTimeEnd = new Date(end);
    // Changement de la date en dd/mm/yyyy
    let dateEnd = dateTimeEnd.getDate() + '/' + (dateTimeEnd.getMonth()) + '/' + dateTimeEnd.getFullYear();
    // Vérification si l'événement est sur une journée entière
    if (dateEnd == '1/0/1970') {
        dateInputEnd = dateInputStart.slice(0, 10) + 'T23:59';
    } else {
        // Changement du format de date pour datetime-local
        dateInputEnd = new Date(dateTimeEnd.setDate(dateTimeEnd.getDate() + 1)).toISOString().slice(0, 10) + 'T' + dateTimeEnd.toTimeString().slice(0, 5);
    }
    let checked = (allDay == true) ? 'checked' : '';
    let disabled = (checked == 'checked') ? 'disabled' : '';
    formContainer.innerHTML =   `<div class="formContainer">
                                    <div class="formContentTitle flexCenterCenter">
                                        <h4>Événement</h4>
                                    </div>
                                    <div class="formAddEvent flexCenterCenterColumn">
                                        <div class="containerInput flexCenterCenter">
                                            <label for="allDayUpdate">Journée entière :</label>
                                            <input type="checkbox" name="allDayUpdate" id="allDayUpdate" value="false" ${checked}>
                                        </div>
                                        <div class="containerInput flexCenterCenterColumn">
                                            <label for="title" class="titleLabel">Titre de l'événement :</label>
                                            <input type="text" name="titleUpdate" value="${title}">
                                        </div>
                                        <div class="containerInputDate flexCenterCenterColumn">
                                            <label for="start" class="titleLabel">Début :</label>
                                            <input type="datetime-local" name="startUpdate" value="${dateInputStart}" ${disabled}>
                                        </div>
                                        <div class="containerInputDate flexCenterCenterColumn">
                                            <label for="end" class="titleLabel">Fin :</label>
                                            <input type="datetime-local" name="endUpdate" value="${dateInputEnd}" ${disabled}>
                                            </div>
                                    </div>
                                    <div class="containerButton">
                                        <button class="modifyButton">Modifier</button>
                                        <button class="cancelButton">Annuler</button>
                                    </div>
                                    <p class="deleteEventButton">Supprimer</p>
                                </div>`;
    const allDayCheckbox = document.querySelector('#allDayUpdate');
    const containerInputDate = document.querySelectorAll('.containerInputDate');
    allDayCheckbox.addEventListener('change', () => {
        if (allDayCheckbox.checked) {
            allDayCheckbox.value = 'true';
            containerInputDate.forEach((container) => {
                container.children[1].setAttribute('disabled', 'disabled'); 
            });
            // Change the value inside the input
            containerInputDate[0].children[1].value = dateInputStart.slice(0, 10) + 'T00:00';
            containerInputDate[1].children[1].value = dateInputEnd.slice(0, 10) + 'T23:59';
        } else {
            allDayCheckbox.value = 'false';
            containerInputDate.forEach((container) => {
                container.children[1].removeAttribute('disabled');
            });
            // Change the value inside the input
            containerInputDate[0].children[1].value = dateInputStart;
            containerInputDate[1].children[1].value = dateInputEnd;
        }
    });
    const cancelButton = document.querySelector('.cancelButton');
    cancelButton.addEventListener('click', () => {
        formContainer.classList.add('hidden');
        formContainer.classList.remove('formContentCss');
        formContainer.innerHTML = '';
        calendarEl.style.opacity = '1';
    });
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
        showModalInput(arg.start, arg.end);
        if (document.querySelector('.addEventButton').addEventListener('click', () => {
            let data = {};
            if (document.querySelector('input[name="allDay"]').value == 'false') {
                data = {
                    title: document.querySelector('input[name="title"]').value,
                    start: document.querySelector('input[name="start"]').value,
                    end: document.querySelector('input[name="end"]').value,
                    allDay: false,
                    whichForm: 1
                };
            } else {
                data = {
                    title: document.querySelector('input[name="title"]').value,
                    start: document.querySelector('input[name="start"]').value,
                    end: document.querySelector('input[name="end"]').value,
                    allDay: true,
                    whichForm: 1
                };
            }
            // Put the data into a form and send it
            const form = document.createElement('form');
            form.method = 'POST';
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
        }));
        calendar.unselect()
    },
    // Update event when drag and drop
    eventDrop: function (arg) {
        const data = {
            idEvent: arg.event.id,
            title: arg.event.title,
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
    // Update and Delete
    eventClick: function (arg) {
        showModalRead(arg.event.start, arg.event.end, arg.event.title, arg.event.allDay);
        if (document.querySelector('.deleteEventButton').addEventListener('click', () => {
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
        }));
        if (document.querySelector('.modifyButton').addEventListener('click', () => {
            let data = {};
            if (document.querySelector('input[name="allDayUpdate"]').value == 'false') {
                data = {
                    idEvent: arg.event.id,
                    title: document.querySelector('input[name="titleUpdate"]').value,
                    start: document.querySelector('input[name="startUpdate"]').value,
                    end: document.querySelector('input[name="endUpdate"]').value,
                    allDay: false,
                    whichForm: 2
                };
            } else {
                data = {
                    idEvent: arg.event.id,
                    title: document.querySelector('input[name="titleUpdate"]').value,
                    start: document.querySelector('input[name="startUpdate"]').value,
                    end: document.querySelector('input[name="endUpdate"]').value,
                    allDay: true,
                    whichForm: 2
                };
            }
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
        }));
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
                        id: item.Id_events,
                        backgroundColor: '#5275EC',
                    })
                } else {
                    calendar.addEvent({
                        title: item.title,
                        start: item.start_at,
                        end: item.end_at,
                        id: item.Id_events,
                        backgroundColor: '#7D97F1',
                    })
                }

            })
        })
    ],
});

calendar.render();