<?php

    // Appel des configurations
    require_once(__DIR__.'/../../config/config.php');
    require_once(__DIR__.'/../../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../../helpers/functions.php');
    require_once(__DIR__.'/../../models/Admin.php');
    require_once(__DIR__.'/../../models/Event.php');

    // Variables
    $style = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/leftbar.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/calendar.css">
    <link rel="stylesheet" href="../public/css/main.css">';
    
    $javascript = '<script defer src="../public/js/openNavbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script defer src="/../../public/js/calendarRender.js"></script>';
    
    $title = TITLE_HEAD[11];
    $description = DESCRIPTION_HEAD[7];

    try {
        // Vérification de la session
        if (isset($_SESSION['id']) && isset($_SESSION['login'])) {
            if (Admin::getId($_SESSION['login']) != $_SESSION['id'] && $_SESSION['time'] < time() - $_SESSION['time']) {
                session_destroy();
                header('Location: /connexion');
                exit();
            } else {
                // Nouvelle date de session
                $_SESSION['time'] = time();
                // ID de l'admin connecté
                $created = $_SESSION['id'];
                // Récupération des tâches

                // Actions effectuées si la méthode est en POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $whichForm = intval(trim(filter_input(INPUT_POST, 'whichForm', FILTER_SANITIZE_NUMBER_INT)), 10);

                    // Formulaire d'ajout d'événement
                    if ($whichForm == 1) {
                        // Filtrage des données
                        $titleEvent = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
                        // Date de début
                        $start_at = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_SPECIAL_CHARS);
                        // Suppression la partie entre les parenthèses
                        $start_at = preg_replace('/\([^)]+\)/', '', $start_at);
                        // Changement du format de date
                        $start_at = new DateTime($start_at, new DateTimeZone('Europe/Paris'));
                        $start_at = $start_at->format('Y-m-d H:i:s');
                        // Date de fin
                        $end_at = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_SPECIAL_CHARS);
                        // Suppression la partie entre les parenthèses
                        $end_at = preg_replace('/\([^)]+\)/', '', $end_at);
                        // Changement du format de date
                        $end_at = new DateTime($end_at, new DateTimeZone('Europe/Paris'));
                        $end_at = $end_at->format('Y-m-d H:i:s');
                        // Journée entière
                        $allDay = filter_input(INPUT_POST, 'allDay', FILTER_SANITIZE_SPECIAL_CHARS) == 'true' ? true : false;
                        if (validationInput($start_at, REGEX_DATE) == true && validationInput($end_at, REGEX_DATE) == true) {
                            // Instanciation de l'objet Event
                            $event = new Event($titleEvent, $start_at, $end_at, $allDay, $created);
                            // Ajout de l'événement
                            $event->add();
                        }

                    // Formulaire de suppression d'événement
                    } else if ($whichForm == 2) {
                        // Filtrage des données
                        $idEvent = intval(trim(filter_input(INPUT_POST, 'idEvent', FILTER_SANITIZE_NUMBER_INT)), 10);
                        if (Event::isExist($idEvent)) {
                            Event::delete($idEvent);
                        }
                    }
                }
            }
        }
    } catch (Exception $e) {
        die ('Erreur : ' . $e->getMessage());
        header('Location: /500');
        exit();
    }

    // Appel des vues
    include (__DIR__.'/../../views/templates/header.php');
    include (__DIR__.'/../../views/admin/leftbar.php');
    include (__DIR__.'/../../views/admin/calendar.php');
    include (__DIR__.'/../../views/templates/footer.php');

