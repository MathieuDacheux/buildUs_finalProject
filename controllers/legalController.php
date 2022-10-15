<?php

    // Appel des configurations
    require_once(__DIR__.'/../config/config.php');
    require_once(__DIR__.'/../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../helpers/functions.php');

    // Variables
    $style = whichCss();
    $javascript = wichJavscript();
    $title = TITLE_HEAD[6];
    $description = DESCRIPTION_HEAD[6];
    
    // Appel des vues
    include (__DIR__.'/../views/templates/header.php');
    include (__DIR__.'/../views/data/legal.php');
    include (__DIR__.'/../views/templates/footer.php');

