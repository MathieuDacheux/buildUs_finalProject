<?php

    // Appel des configurations
    require_once(__DIR__.'/../../config/config.php');
    require_once(__DIR__.'/../../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../../helpers/functions.php');

    // Appel des modèles
    require_once(__DIR__.'/../../helpers/Pages.php');
    require_once(__DIR__.'/../../models/Admin.php');
    require_once(__DIR__.'/../../models/Employee.php');

    // Variables
    $style = '<link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/leftbar.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/listing.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/rightbar.css">';

    $javascript = '<script defer src="../public/js/openNavbar.js"></script>
    <script defer src="../public/js/openModal.js"></script>
    <script defer src="../public/js/registrationState.js"></script>';
    
    $title = TITLE_HEAD[10];
    $description = DESCRIPTION_HEAD[7];

    try {
        // Vérification de la session
        if (isset($_SESSION['id']) && isset($_SESSION['login'])) {
            if (Admin::getId($_SESSION['login']) != $_SESSION['id'] && $_SESSION['time'] < time() - SESSION_TIME) {
                session_destroy();
                header('Location: /connexion');
                exit();
            } else {
                // Nouvelle date de session
                $_SESSION['time'] = time();
                // ID de l'admin connecté
                $created = $_SESSION['id'];
                
                // Listing des employés
                $display = Pages::display($created);
    
                // Actions effectuées si la méthode est en POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
                    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
                    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
                    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
                    $income = floatval(trim(filter_input(INPUT_POST, 'income', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)));
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
                    if (validationInput($income, REGEX_INCOME) != true) {
                        $errorsRegistration['income'] = validationInput($income, REGEX_INCOME);
                    }
    
                    // Si tableau d'erreurs vide
                    if (empty($errorsRegistration)) {
                        // Instanciation de l'objet Employee
                        $employee = new Employee($firstname, $lastname, $mail, $phone, $income, $created, $adress);
                        // Vérification de l'unicité du numéro de téléphone
                        if ($employee->isExist() == true) {
                            $isExist = true;
                        } else {
                            // Ajout de l'employé
                            if ($employee->add() == true) {
                                $confirmation = true;
                            } else {
                                $confirmation = false;
                            }
                        }
                    }
                }
            }
        } else {
            header('Location: /connexion');
            exit();
        }
    } catch (Exception $e) {
        header('Location: /500');
        exit();
    }


    // Appel des vues
    include (__DIR__.'/../../views/templates/header.php');
    include (__DIR__.'/../../views/admin/leftbar.php');
    include (__DIR__.'/../../views/admin/employeesList.php');
    include (__DIR__.'/../../views/admin/rightbar.php');
    include (__DIR__.'/../../views/templates/footer.php');