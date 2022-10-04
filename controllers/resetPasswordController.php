<?php

    // Appel des configurations
    require_once(__DIR__.'/../config/config.php');
    require_once(__DIR__.'/../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../helpers/functions.php');

    // Variables
    $style = whichCss();
    $javascript = wichJavscript();
    $title = TITLE_HEAD[3];
    $description = DESCRIPTION_HEAD[3];
    
    // Actions effectuées si la méthode est en POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Filtrage des inputs
        $userLogin = trim(filter_input(INPUT_POST, 'userLogin', FILTER_SANITIZE_SPECIAL_CHARS));
        // Validation des inputs
        if (validationInput($userLogin, REGEX_MAIL) != 'true') {
            $errorForgot['userLogin'] = validationInput($userLogin, REGEX_MAIL);
        }
    }

    // Appel des vues
    include (__DIR__.'/../views/templates/header.php');
    include (__DIR__.'/../views/resetPassword.php');
    include (__DIR__.'/../views/templates/footer.php');

