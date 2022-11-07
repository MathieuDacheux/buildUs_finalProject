<?php
    
    // Appel des configurations
    require_once(__DIR__.'/../config/config.php');
    require_once(__DIR__.'/../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../helpers/functions.php');

    // Appel du modèle
    require_once(__DIR__.'/../../buildus/models/Admin.php');

    // Variables
    $style = whichCss(); 
    $javascript = wichJavscript();
    $title = TITLE_HEAD[1];
    $description = DESCRIPTION_HEAD[1];

    // Appel des vues
    include (__DIR__.'/../views/templates/header.php');

    // Actions effectuées si la méthode est en POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Filtrage des inputs
        $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];
        $cgu = filter_input(INPUT_POST, 'CGU', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);
        $newsletter = (filter_input(INPUT_POST, 'newsletter', FILTER_SANITIZE_NUMBER_INT));

        // Validation des inputs
        if (validationInput($mail, REGEX_MAIL) != 'true') {
            $errorsRegistration['mail'] = validationInput($mail, REGEX_MAIL);
        }
        if (validationInput($lastname, REGEX_NAME) != 'true') {
            $errorsRegistration['lastname'] = validationInput($lastname, REGEX_NAME);
        }
        if (validationInput($firstname, REGEX_NAME) != 'true') {
        $errorsRegistration['firstname'] = validationInput($firstname, REGEX_NAME);
        }
        if (validationInput($password, REGEX_PASSWORD) != 'true') {
            $errorsRegistration['password'] = validationInput($password, REGEX_PASSWORD);
        }        
        if (validationInput($passwordConfirm, REGEX_PASSWORD) != 'true') {
            $errorsRegistration['passwordConfirm'] = validationInput($passwordConfirm, REGEX_PASSWORD);
        }
        if ($password != $passwordConfirm) {
            $errorsRegistration['password'] = 'Les mots de passe doivent être identiques';
        }
        if ($cgu[0] != 1 && $cgu[1] != 2) {
            $errorsRegistration['cgu'] = 'Les champs doivent être cochés';
        }
        if ($newsletter == 1) {
            $newsletter = true;
        } else if ($newsletter == NULL){
            $newsletter = false;
        } else {
            $errorsRegistration['newsletter'] = 'Ce champs n\'est pas conforme';
        }

        // Si tableau d'erreurs vide
        if (empty($errorsRegistration)) {
            // Instanciation de l'objet Admin
            $admin = new Admin($firstname, $lastname, $mail, $password, $newsletter);
            // Vérification de l'unicité de l'email
            try {
                if ($admin->isExist() == true) {
                    $errorsRegistration['mail'] = 'Cet email est déjà utilisé';
                } else {
                    // Ajout de l'utilisateur
                    if ($admin->add() == true) {
                        $succes = 'Votre compte a bien été créé';
                        // Redirection vers la page de connexion
                        header('Location: /connexion');
                        exit();
                    }
                }
            } catch (Exception $e) {
                header('Location: /500');
                exit();
            }
        }
    }

    include (__DIR__.'/../views/registration.php');
    include (__DIR__.'/../views/templates/footer.php');