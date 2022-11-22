<?php

    // Appel des configurations
    require_once(__DIR__.'/../../config/config.php');
    require_once(__DIR__.'/../../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../../helpers/functions.php');

    // Appel du modèle
    require_once(__DIR__.'/../../models/Admin.php');
    require_once(__DIR__.'/../../models/Employee.php');
    require_once(__DIR__.'/../../models/Client.php');

    // Variables
    $style = '<link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/leftbar.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/dashboard.css">';

    $javascript = '<script defer src="../public/js/openNavbar.js"></script>';
    
    $title = TITLE_HEAD[7];
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
                // Récupération des données de l'admin
                $created = $_SESSION['id'];
                // Affichage des derniers employés
                $lastEmployees = Employee::get($created);
                // Affichage des derniers clients
                $lastClients = Client::get($created);
            }
        } else {
            header('Location: /connexion');
            exit();
        }
    } catch (Exception $e) {
        header('Location: /500');
        exit();
    }

    // Appel des vues
    include (__DIR__.'/../../views/templates/header.php');
    include (__DIR__.'/../../views/admin/leftbar.php');
    include (__DIR__.'/../../views/admin/main.php');
    include (__DIR__.'/../../views/templates/footer.php');

