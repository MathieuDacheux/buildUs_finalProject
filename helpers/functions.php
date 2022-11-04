<?php

    /******************** ********************/
    /****************** STYLE ****************/
    /******************** ********************/

    // !ECRITURE DU BON CSS DANS LE HEAD EN FONCTION DE L'URL DU NAVIGATEUR
    function whichCss() {
        if ($_SERVER['REQUEST_URI'] == '/accueil') {
            $style = '<link rel="stylesheet" href="../public/css/main.css">
                    <link rel="stylesheet" href="../public/css/header.css">
                    <link rel="stylesheet" href="../public/css/section.css">
                    <link rel="stylesheet" href="../public/css/footer.css">
                    <link rel="stylesheet" href="../public/css/keyframe.css">';
            return $style;
        } else if ($_SERVER['REQUEST_URI'] == '/inscription') {
            $style = '<link rel="stylesheet" href="../public/css/main.css">
                    <link rel="stylesheet" href="../public/css/registration.css">';
            return $style;
        } else if ($_SERVER['REQUEST_URI'] == '/connexion') {
            $style = '<link rel="stylesheet" href="../public/css/main.css">
                    <link rel="stylesheet" href="../public/css/login.css">';
            return $style;
        } else if ($_SERVER['REQUEST_URI'] == '/reinitialiser') {
            $style = '<link rel="stylesheet" href="../public/css/main.css">
                    <link rel="stylesheet" href="../public/css/forget.css">';
            return $style;
        } else if ($_SERVER['REQUEST_URI'] == '/404') {
            $style = '<link rel="stylesheet" href="../public/css/main.css">
                    <link rel="stylesheet" href="../public/css/404.css">';
            return $style;
        } else if ($_SERVER['REQUEST_URI'] == '/500') {
                $style = '<link rel="stylesheet" href="../public/css/main.css">
                        <link rel="stylesheet" href="../public/css/404.css">';
                return $style;
        } else if ($_SERVER['REQUEST_URI'] == '/cgu') {
            $style = '<link rel="stylesheet" href="../public/css/main.css">
                <link rel="stylesheet" href="../public/css/header.css">
                <link rel="stylesheet" href="../public/css/footer.css">
                <link rel="stylesheet" href="../public/css/conditions.css">';
            return $style;
        } else if ($_SERVER['REQUEST_URI'] == '/confidentialite') {
            $style = '<link rel="stylesheet" href="../public/css/main.css">
                <link rel="stylesheet" href="../public/css/header.css">
                <link rel="stylesheet" href="../public/css/footer.css">
                <link rel="stylesheet" href="../public/css/conditions.css">';
            return $style;
        }
    }

    // !ECRITURE DU BON JAVASCRIPT DANS LE HEAD EN FONCTION DE L'URL DU NAVIGATEUR
    function wichJavscript() {
        if ($_SERVER['REQUEST_URI'] == '/accueil') {
            $javascript = '<script defer src="../public/js/openNavbar.js"></script>';
            return $javascript;
        } else if ($_SERVER['REQUEST_URI'] == '/inscription') {
            $javascript = '<script defer src="../public/js/regexRegistration.js"></script>';
            return $javascript;
        } else if ($_SERVER['REQUEST_URI'] == '/connexion') {
            $javascript = '';
            return $javascript;
        } else if ($_SERVER['REQUEST_URI'] == '/dashboard') {
            $javascript = '<script defer src="../public/js/openNavbar.js"></script>';
            return $javascript;
        } else if ($_SERVER['REQUEST_URI'] == '/cgu') {
            $javascript = '<script defer src="../public/js/openNavbar.js"></script>';
            return $javascript;
        } else if ($_SERVER['REQUEST_URI'] == '/confidentialite') {
            $javascript = '<script defer src="../public/js/openNavbar.js"></script>';
            return $javascript;
        }
    }
    
    /******************** ********************/
    /************** VALIDATION ***************/
    /******************** ********************/
    
    // !VALIDATION DES INPUTS
    function validationInput ($var, $REGEX) {
        if(empty($var)) {
            $error = 'Ce champs est obligatoire';
            return $error;
        } else {
            $isOk = filter_var($var, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/'.$REGEX.'/')));
            if (!$isOk) {
                $error = 'Ce champs n\'est pas conforme';
                return $error;
            } else {
                return true;
            }
        }
    }