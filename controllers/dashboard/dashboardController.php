<?php

    // Appel des configurations
    require_once(__DIR__.'/../../config/config.php');
    require_once(__DIR__.'/../../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../../helpers/functions.php');

    // Appel du modèle
    require_once(__DIR__.'/../../models/Admin.php');

    // Variables
    $style = '<link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/leftbar.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/dashboard.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/rightbar.css">';

    $javascript = '<script defer src="../public/js/openNavbar.js"></script>';
    
    $title = TITLE_HEAD[7];
    $description = DESCRIPTION_HEAD[7];

    // Vérification de la session
    if (isset($_SESSION['id']) && isset($_SESSION['login'])) {
        try {
            if (Admin::getId($_SESSION['login']) != $_SESSION['id']) {
                session_destroy();
                header('Location: /connexion');
                exit();
            }
        } catch (Exception $e) {
            header('Location: /500');
            exit();
        }
    } else {
        header('Location: /connexion');
        exit();
    }

    // Appel des vues
    include (__DIR__.'/../../views/templates/header.php');
    include (__DIR__.'/../../views/admin/leftbar.php');
    include (__DIR__.'/../../views/admin/main.php');
    include (__DIR__.'/../../views/admin/rightbar.php');
    include (__DIR__.'/../../views/templates/footer.php');

