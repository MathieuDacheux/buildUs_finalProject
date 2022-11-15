<?php

    // Appel des configurations
    require_once(__DIR__.'/../config/config.php');
    require_once(__DIR__.'/../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../helpers/functions.php');

    // Appel des modèles
    require_once(__DIR__.'/../helpers/Validation.php');
    require_once(__DIR__.'/../helpers/Mail.php');
    require_once(__DIR__.'/../models/Admin.php');


    // Variables
    $style = '<link rel="stylesheet" href="../public/css/main.css">
            <link rel="stylesheet" href="../public/css/forget.css">';
    $javascript = '<script defer src="../public/js/resetPassword.js"></script>';
    $title = TITLE_HEAD[3];
    $description = DESCRIPTION_HEAD[3];

    // Action effectuées si la méthode est en POST et si le token est valide
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['token'])) {
        $token = $_GET['token'];
        $id = intval(JWT::decodeToken($token) ,10);

        // Récupération des données du formulaire
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];

        // Validation des inputs
        if ($password != $passwordConfirm) {
            $errorForgot['password'] = 'Les mots de passe doivent être identiques';
        }

        // Si tableau d'erreurs vide
        if (empty($errorForgot)) {
            if (Admin::getId('', $id) == $id) {
                // Hashage du mot de passe
                $password = password_hash($password, PASSWORD_BCRYPT);
                
                // Update du mot de passe
                if (Admin::updatePassword($password, $id) == true) {
                    $success = true;
                } else {
                    $errorForgot['password'] = 'Une erreur est survenue';
                }
            } else {
                $errorForgot['password'] = 'Une erreur est survenue';
            }
        }
    }
    
    // Actions effectuées si la méthode est en POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Filtrage des inputs
        $userLogin = trim(filter_input(INPUT_POST, 'userLogin', FILTER_SANITIZE_EMAIL));
        // Validation des inputs
        if (validationInput($userLogin, REGEX_MAIL) != 'true') {
            $errorForgot['userLogin'] = validationInput($userLogin, REGEX_MAIL);
        }

        // Si tableau d'erreurs vide
        if (empty($errorForgot)) {
            if (Admin::isExist($userLogin) == true) {
                if (Admin::isActivated(Admin::getId($userLogin)) == true) {
                    if (Mail::resetPassword($userLogin, Admin::getId($userLogin)) == true ) {
                        $success = true;
                    } else {
                        $errorForgot['userLogin'] = 'Une erreur est survenue lors de l\'envoi du mail';
                    }
                } else {
                    $errorForgot['userLogin'] = 'Ce compte n\'est pas activé';
                }
            } else {
                $errorForgot['userLogin'] = 'Cet utilisateur n\'existe pas';
            }       
        }
    }

    // Appel des vues
    include (__DIR__.'/../views/templates/header.php');
    include (__DIR__.'/../views/resetPassword.php');
    include (__DIR__.'/../views/templates/footer.php');

