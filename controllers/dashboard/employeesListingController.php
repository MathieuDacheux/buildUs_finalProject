<?php

    // Appel des configurations
    require_once(__DIR__.'/../../config/config.php');
    require_once(__DIR__.'/../../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../../helpers/functions.php');

    // Variables
    $style = whichCss();
    $javascript = wichJavscript();
    $title = TITLE_HEAD[9];
    $description = DESCRIPTION_HEAD[7];

    // Appel des vues
    include (__DIR__.'/../../views/templates/header.php');
    include (__DIR__.'/../../views/admin/leftbar.php');
    include (__DIR__.'/../../views/admin/employeesList.php');
    include (__DIR__.'/../../views/admin/rightbar.php');
    include (__DIR__.'/../../views/templates/footer.php');

