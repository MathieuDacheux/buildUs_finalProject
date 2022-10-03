<?php
    
    // Appel des configurations
    require_once(__DIR__.'/../config/config.php');
    require_once(__DIR__.'/../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../helpers/functions.php');

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
        $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_SPECIAL_CHARS));
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];
        $cgu = filter_input(INPUT_POST, 'CGU', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);
        $newsletter = (filter_input(INPUT_POST, 'newsletter', FILTER_SANITIZE_NUMBER_INT));

        // Validation des inputs
        $errorsRegistration['mail'] = validationInput($mail, REGEX_MAIL);
        $errorsRegistration['lastname'] = validationInput($lastname, REGEX_NAME);
        $errorsRegistration['firstname'] = validationInput($firstname, REGEX_NAME);
        $errorsRegistration['password'] = validationInput($password, REGEX_PASSWORD);
        $errorsRegistration['passwordConfirm'] = validationInput($passwordConfirm, REGEX_PASSWORD);

        var_dump($newsletter);

        if ($password != $passwordConfirm) {
            $errorsRegistration['password'] = 'Les mots de passe doivent être identiques';
        }

        if (empty($cgu)) {
            $errorsRegistration['CGU'] = 'Ce champs est obligatoire';
        } else if ($cgu[0] != 1 || $cgu[1] != 2) {
            $errorsRegistration['CGU'] = 'Ce champs est obligatoire';
        }

        if ($newsletter != 1 &&  $newsletter != NULL)  {
            $errorsRegistration['newsletter'] = 'Ce champs n\'est pas conforme';
        }
    }

    include (__DIR__.'/../views/registration.php');
    include (__DIR__.'/../views/templates/footer.php');