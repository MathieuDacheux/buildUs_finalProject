<?php

    // Appel des configurations
    require_once(__DIR__.'/../../config/config.php');
    require_once(__DIR__.'/../../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../../helpers/functions.php');

    // Appel des modèles
    require_once(__DIR__.'/../../models/Admin.php');

    // Variables
    $style = '<link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/leftbar.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/settings.css">';

    $javascript = '<script defer src="../public/js/openNavbar.js"></script>
    <script defer src="../public/js/deleteAccount.js"></script>';
    
    $title = TITLE_HEAD[8];
    $description = DESCRIPTION_HEAD[7];

    try {
        // Vérification de la session
        if (isset($_SESSION['id']) && isset($_SESSION['login'])) {
            if (Admin::getId($_SESSION['login']) != $_SESSION['id'] && $_SESSION['time'] < time() - $_SESSION['time']) {        
                session_destroy();
                header('Location: /connexion');
                exit();
            } else {
                // Nouvelle date de session
                $_SESSION['time'] = time();
                // ID de l'admin connecté
                $created = $_SESSION['id'];
    
                // Affichage des informations de l'admin
                $admin = Admin::getOne();
    
                // Actions effectuées si la méthode est en POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
                    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
                    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
    
                    // Validationd des inputs
                    if (validationInput($mail, REGEX_MAIL) != true) {
                        $errorsModify['mail'] = validationInput($mail, REGEX_MAIL);
                    }
                    if (validationInput($lastname, REGEX_NAME) != true) {
                        $errorsModify['lastname'] = validationInput($lastname, REGEX_NAME);
                    }
                    if (validationInput($firstname, REGEX_NAME) != true) {
                        $errorsModify['firstname'] = validationInput($firstname, REGEX_NAME);
                    }
    
                    // Si tableau d'erreurs vide
                    if (empty($errorsModify)){
                        if (Admin::isExist($mail) == true) {
                            $errorsModify['mail'] = 'Cette adresse mail est déjà utilisée';
                        } else {
                            // Modification des informations de l'admin
                            Admin::updateProfil($firstname, $lastname, $mail, $created);
                            header('Location: /dashboard');
                            exit();
                        }
                    }
                }

                // Suppression du compte
                if (isset($_GET['delete'])) {
                    if ($_GET['delete'] == 'true') {
                        // Supprimer tout les clients et employés liés à l'admin ainsi que tout les pdf liés à ces clients et employés
                        $resultCreated = Admin::deleteCreatedBy($created);
                        // Suppression des dossiers liés aux clients et employés
                        foreach ($resultCreated as $value) {
                            $idUser = intval($value->Id_users, 10);
                            if (file_exists($_SERVER['DOCUMENT_ROOT'].'/public/uploads/'.$idUser)) {
                                $files = scandir($_SERVER['DOCUMENT_ROOT'].'/public/uploads/'.$idUser);
                                foreach ($files as $file) {
                                    if ($file != '.' && $file != '..') {
                                        unlink($_SERVER['DOCUMENT_ROOT'].'/public/uploads/'.$idUser.'/'.$file);
                                    }
                                }
                                rmdir($_SERVER['DOCUMENT_ROOT'].'/public/uploads/'.$idUser);
                            }
                            Admin::delete($idUser);
                        }
                        // Suppression de l'admin
                        Admin::delete($created);
                        session_destroy();
                        header('Location: /accueil');
                        exit();
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
    include (__DIR__.'/../../views/admin/settings.php');
    include (__DIR__.'/../../views/templates/footer.php');

