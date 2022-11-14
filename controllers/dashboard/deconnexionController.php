<?php

    // Appel des configurations
    require_once(__DIR__.'/../../config/config.php');
    require_once(__DIR__.'/../../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../../helpers/functions.php');

    // Appel du modèle
    require_once(__DIR__.'/../../helpers/Database.php');

    if (isset($_GET['deconnexion'])) {
        $deconnexion = $_GET['deconnexion'];
        if ($deconnexion == 'true') {
            session_destroy();
            header('Location: /connexion');
            exit();
        }
    }
    
