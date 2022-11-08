<?php

    // Appel des configurations
    require_once(__DIR__.'/../config/config.php');
    require_once(__DIR__.'/../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../helpers/functions.php');

    // Appel du modèle
    require_once(__DIR__.'/../models/Admin.php');

    // Variables
    $style = '<link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="../public/css/login.css">';
    $javascript = wichJavscript();
    $title = TITLE_HEAD[2];
    $description = DESCRIPTION_HEAD[2];

    // Instanciation de la session
    session_start();

    // Vérification de la session
    if (isset($_SESSION['id']) && isset($_SESSION['login'])) {
        if (Admin::getId($_SESSION['login']) != $_SESSION['id']) {
            session_destroy();
            header('Location: /connexion');
            exit();
        } else {
            header('Location: /dashboard');
            exit();
        }
    }

    // Actions effectuées si la méthode est en GET
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        try {
            if (Admin::validationAccount(Admin::decodeToken($token)) == true) {
                $succes = true;
            } else {
                $succes = false;
            }
        } catch (Exception $e) {
            header('Location: /500');
            exit();
        }
    }

    // Actions effectuées si la méthode est en POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Filtrage des inputs
        $userLogin = trim(filter_input(INPUT_POST, 'userLogin', FILTER_SANITIZE_SPECIAL_CHARS));
        $userPassword = $_POST['userPassword'];
        // Validation des inputs
        if (validationInput($userLogin, REGEX_MAIL) != 'true') {
            $errorConnexion['userLogin'] = validationInput($userLogin, REGEX_MAIL);
        }
        // Si tableau d'erreurs vide
        if (empty($errorConnexion)) {
            try {
                if (Admin::loginVerification($userLogin, $userPassword) == true) {
                    $id = Admin::getId($userLogin);
                    // Création de la session utilisateur connecté
                    $_SESSION['id'] = $id;
                    $_SESSION['login'] = $userLogin;
                    // Redirection vers la page d'accueil du dashboard
                    header('Location: /dashboard');
                    exit();
                } else {
                    $errorConnexion['userLogin'] = 'Identifiant ou mot de passe incorrect';
                }
            } catch (Exception $e) {
                header('Location: /500');
                exit();
            }
        }
    }

    // Appel des vues
    include (__DIR__.'/../views/templates/header.php');
    include (__DIR__.'/../views/connexion.php');
    include (__DIR__.'/../views/templates/footer.php');

