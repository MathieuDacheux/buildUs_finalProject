<?php

    // Appel des configurations
    require_once(__DIR__.'/../../config/config.php');
    require_once(__DIR__.'/../../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../../helpers/functions.php');

    // Appel des modèles
    require_once(__DIR__.'/../../models/Admin.php');

    // Variables
    $style = '<link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/leftbar.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/settings.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/rightbar.css">';

    $javascript = '<script defer src="../public/js/openNavbar.js"></script>';
    
    $title = TITLE_HEAD[8];
    $description = DESCRIPTION_HEAD[7];

    try {
        // Vérification de la session
        if (isset($_SESSION['id']) && isset($_SESSION['login'])) {
            if (Admin::getId($_SESSION['login']) != $_SESSION['id'] && $_SESSION['time'] < time() - SESSION_TIME) {        
                session_destroy();
                header('Location: /connexion');
                exit();
            } else {
                // Nouvelle date de session
                $_SESSION['time'] = time();
                // ID de l'admin connecté
                $created = $_SESSION['id'];
    
                // Affichage des informations de l'admin
                $admin = Admin::getOne();
    
                // Actions effectuées si la méthode est en POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
                    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
                    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
    
                    // Validationd des inputs
                    if (validationInput($mail, REGEX_MAIL) != true) {
                        $errorsModify['mail'] = validationInput($mail, REGEX_MAIL);
                    }
                    if (validationInput($lastname, REGEX_NAME) != true) {
                        $errorsModify['lastname'] = validationInput($lastname, REGEX_NAME);
                    }
                    if (validationInput($firstname, REGEX_NAME) != true) {
                        $errorsModify['firstname'] = validationInput($firstname, REGEX_NAME);
                    }
    
                    // Si tableau d'erreurs vide
                    if (empty($errorsModify)){
                        // Upate des informations de l'admin
                        Admin::updateProfil($firstname, $lastname, $mail, $created);
                        header('Location: /dashboard/parametres');
                        exit();
                    }
                }
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
    include (__DIR__.'/../../views/admin/settings.php');
    include (__DIR__.'/../../views/admin/rightbar.php');
    include (__DIR__.'/../../views/templates/footer.php');

