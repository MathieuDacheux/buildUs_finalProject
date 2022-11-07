<?php

    // Appel des configurations
    require_once(__DIR__.'/../../config/config.php');
    require_once(__DIR__.'/../../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../../helpers/functions.php');

    // Appel du modèle
    require_once(__DIR__.'/../../models/Client.php');

    // Variables
    $style = '<link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/leftbar.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/listing.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/rightbar.css">';
    
    $javascript = '<script defer src="../public/js/openNavbar.js"></script>
    <script defer src="../public/js/openModal.js"></script>
    <script defer src="../public/js/registrationState.js"></script>';
    
    $title = TITLE_HEAD[9];
    $description = DESCRIPTION_HEAD[7];

    // Listing des employés
    $howManyPages = Client::howManyPages();
    $whichPage = Client::whichPage();
    $tenClients = Client::getTen();

    // Actions effectuées si la méthode est en POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
        $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
        $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
        $siret = trim(filter_input(INPUT_POST, 'siret', FILTER_SANITIZE_NUMBER_INT));
        $adress = trim(filter_input(INPUT_POST, 'adress', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validationd des inputs
        if (validationInput($lastname, REGEX_NAME) != true) {
            $errorsRegistration['lastname'] = validationInput($lastname, REGEX_NAME);
        }
        if (validationInput($firstname, REGEX_NAME) != true) {
            $errorsRegistration['firstname'] = validationInput($firstname, REGEX_NAME);
        }
        if (validationInput($mail, REGEX_MAIL) != true) {
            $errorsRegistration['mail'] = validationInput($mail, REGEX_MAIL);
        }
        if (validationInput($phone, REGEX_PHONE) != true) {
            $errorsRegistration['phone'] = validationInput($phone, REGEX_PHONE);
        }
        if (validationInput($siret, REGEX_SIRET) != true) {
            $errorsRegistration['siret'] = validationInput($siret, REGEX_INCOME);
        }

        // Si tableau d'erreurs vide
        if (empty($errorsRegistration)) {
            // Instanciation de l'objet Employee
            $client = new Client($firstname, $lastname, $mail, $phone, $siret, $adress);
            // Vérification de l'unicité du numéro de SIRET
            try {
                if ($client->isExist() == true) {
                    $isExist = true;
                } else {
                    // Ajout de l'employé
                    if ($client->add() == true) {
                        $confirmation = true;
                    } else {
                        $confirmation = false;
                    }
                }
            } catch (Exception $e) {
                header('Location: /clients');
                exit();
            }
        }
    }

    // Appel des vues
    include (__DIR__.'/../../views/templates/header.php');
    include (__DIR__.'/../../views/admin/leftbar.php');
    include (__DIR__.'/../../views/admin/clientsList.php');
    include (__DIR__.'/../../views/admin/rightbar.php');
    include (__DIR__.'/../../views/templates/footer.php');

