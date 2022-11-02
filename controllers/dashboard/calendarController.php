<?php

    // Appel des configurations
    require_once(__DIR__.'/../../config/config.php');
    require_once(__DIR__.'/../../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../../helpers/functions.php');

    // Variables
    $style = $style = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/leftbar.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/calendar.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/rightbar.css">
    <link rel="stylesheet" href="../public/css/main.css">';
    
    $javascript = '<script defer src="../public/js/openNavbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>

      document.addEventListener(\'DOMContentLoaded\', function() {
        // Création d\'un objet FullCalendar
        var calendarEl = document.getElementById(\'calendar\');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: \'dayGridMonth\',
          initialDate: \'2021-09-07\',
          locale: \'fr\',
          buttonText: {
            dayGridMonth: \'Mois\',
            timeGridWeek: \'Semaine\',
            timeGridDay: \'Jour\',
            today: \'Aujourd\\\'hui\',
          },
          headerToolbar: {
            left: \'prev,next today\',
            center: \'title\',
            right: \'dayGridMonth,timeGridWeek,timeGridDay\'
          },
          calendar.addEvent({
            title: \'All Day Event\',
            start: \'2021-09-01\'
          })

          
        });
        calendar.render();
      });
    </script>';
    
    $title = TITLE_HEAD[11];
    $description = DESCRIPTION_HEAD[7];

    // Appel des vues
    include (__DIR__.'/../../views/templates/header.php');
    include (__DIR__.'/../../views/admin/leftbar.php');
    include (__DIR__.'/../../views/admin/calendar.php');
    include (__DIR__.'/../../views/admin/rightbar.php');
    include (__DIR__.'/../../views/templates/footer.php');

