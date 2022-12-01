/********************************* ********************************/
/****************** Création du FullCalendar.Js *******************/
/******************************** *********************************/

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

    // Create new event
    select: function (arg) {
        var title = prompt('Titre de l\'événement:');
        if (title) {
            const data = {
                title: title,
                start: arg.start,
                end: arg.end,
                allDay: arg.allDay,
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
        }
        calendar.unselect()
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



