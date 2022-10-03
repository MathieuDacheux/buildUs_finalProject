<?php

    // Appel des configurations
    require_once(__DIR__.'/../config/config.php');

    // Appel des fonctions
    require_once(__DIR__.'/../helpers/functions.php');

    // Variables
    $style = whichCss();
    $javascript = wichJavscript();
    $title = TITLE_HEAD[0];
    $description = DESCRIPTION_HEAD[0];

    // Appel des vues
    include (__DIR__.'/../views/templates/header.php');
    include (__DIR__.'/../views/home/navbar.php');
    include (__DIR__.'/../views/home/started.php');
    include (__DIR__.'/../views/home/price.php');
    include (__DIR__.'/../views/home/features.php');
    include (__DIR__.'/../views/home/newsletter.php');
    include (__DIR__.'/../views/home/footer.php');
    include (__DIR__.'/../views/templates/footer.php');