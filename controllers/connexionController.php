<?php

    // Appel des configurations
    require_once(__DIR__.'/../config/config.php');
    require_once(__DIR__.'/../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../helpers/functions.php');

    // Variables
    $style = whichCss();
    $javascript = wichJavscript();
    $title = TITLE_HEAD[2];
    $description = DESCRIPTION_HEAD[2];
    
    // Actions effectuées si la méthode est en POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    }

    // Appel des vues
    include (__DIR__.'/../views/templates/header.php');
    include (__DIR__.'/../views/connexion.php');
    include (__DIR__.'/../views/templates/footer.php');

