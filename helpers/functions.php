<?php

    // !ECRITURE DU BON CSS DANS LE HEAD EN FONCTION DE L'URL DU NAVIGATEUR
    function whichCss() {
        if ($_SERVER['REQUEST_URI'] == '/controllers/homeController.php') {
            $style = '<link rel="stylesheet" href="../public/css/main.css">
                    <link rel="stylesheet" href="../public/css/header.css">
                    <link rel="stylesheet" href="../public/css/section.css">
                    <link rel="stylesheet" href="../public/css/footer.css">
                    <link rel="stylesheet" href="../public/css/keyframe.css">';
            return $style;
        } else if ($_SERVER['REQUEST_URI'] == '/controllers/registrationController.php') {
            $style = '<link rel="stylesheet" href="../public/css/main.css">
                    <link rel="stylesheet" href="../public/css/registration.css">
                    <link rel="stylesheet" href="../public/css/keyframe.css">';
            return $style;
        } else if ($_SERVER['REQUEST_URI'] == '/controllers/connexionController.php') {
            $style = '<link rel="stylesheet" href="../public/css/main.css">
                    <link rel="stylesheet" href="../public/css/login.css">
                    <link rel="stylesheet" href="../public/css/keyframe.css">';
            return $style;
        }
    }

    function wichJavscript() {
        if ($_SERVER['REQUEST_URI'] == '/controllers/homeController.php') {
            $javascript = '<script defer src="../public/js/openNavbar.js"></script>';
            return $javascript;
        } else if ($_SERVER['REQUEST_URI'] == '/controllers/registrationController.php') {
            $javascript = '<script defer src="../public/js/regexRegistration.js"></script>';
            return $javascript;
        } else if ($_SERVER['REQUEST_URI'] == '/controllers/connexionController.php') {
            $javascript = '';
            return $javascript;
        }
    }