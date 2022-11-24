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
                    // Filtrage des données 
                    $start_at = trim(filter_input(INPUT_POST, 'event', FILTER_SANITIZE_SPECIAL_CHARS));
                    
                    $event = new Event($created, $start_at);
                    if ($event->add() == true) {
                        $registerConfirmation = true;
                    } else {
                        $registerConfirmation = false;
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

