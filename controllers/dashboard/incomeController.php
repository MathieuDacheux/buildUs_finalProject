<?php

    // Appel des configurations
    require_once(__DIR__.'/../../config/config.php');
    require_once(__DIR__.'/../../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../../helpers/functions.php');

    // Appel des modèles
    require_once(__DIR__.'/../../models/Admin.php');
    require_once(__DIR__.'/../../models/Income.php');

    // Variables
    $style = '<link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/leftbar.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/income.css">';

    $javascript = '<script defer src="../public/js/openNavbar.js"></script>
    <script defer src="../public/js/chartGraph.js"></script>';
    
    $title = TITLE_HEAD[13];
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

                // Récupération des revenus des 7 derniers jours
                $incomeDisplay = Income::getSevenDays($created);
    
                // Actions effectuées si la méthode est en POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Quelle formulaire a été envoyé
                    $whichForm = trim(filter_input(INPUT_POST, 'whichForm', FILTER_SANITIZE_NUMBER_INT));

                    if ($whichForm == 1) {
                        // Filtrage des données
                        $amount = trim(filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
                        // Validation des données
                        if (validationInput($amount, REGEX_INCOME) != true) {
                            $errorsRegistration['amount'] = 'Le montant doit être un nombre';
                        }

                        // Si tableau d'erreurs vide
                        if (empty($errorsRegistration)) {
                            // Récupération du dernier revenu enregistré
                            $lastIncome = Income::getLastIncome($created);
                            if (date('d-m-Y', strtotime($lastIncome->income_date)) == date('d-m-Y')) {
                                Income::update($lastIncome->Id_incomes, $amount);
                            } else {
                                $newIncome = new Income($amount, $created);
                                $newIncome->add();
                            }
                            // Redirection vers la page des revenus
                            header('Location: /dashboard/business');
                            exit();
                        }
                    } else if ($whichForm == 2) {
                        // Filtrage des données
                        $target = trim(filter_input(INPUT_POST, 'target', FILTER_SANITIZE_NUMBER_INT));
                        var_dump($target);
                        // Validation des données
                        if (validationInput($target, REGEX_INCOME) != true) {
                            $errorsRegistration['amount'] = 'Le montant doit être un nombre';
                        }

                        // Si tableau d'erreurs vide
                        if (empty($errorsRegistration)) {
                            // Récupération du dernier revenu enregistré
                            Admin::updateTarget($target, $created);
                            // Redirection vers la page des revenus
                            header('Location: /dashboard/business');
                            exit();
                        }
                    }

                }
                // Si la méthode est en GET et que delete et ID sont définis
                if ($_GET['delete'] = '1' && isset($_GET['id'])) {
                    var_dump($_GET['id']);
                    // Filtrage des données
                    $id = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
                    var_dump($id);

                    // Vérification si l'ID existe
                    if (Income::isExist($id, $created) == true) {
                        // Suppression du revenu
                        Income::delete($id, $created);
                        header('Location: /dashboard/business');
                        exit();
                    } else {
                        echo 'Erreur';
                    }
                }
            }
        } else {
            header('Location: /connexion');
            exit();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
        header('Location: /500');
        exit();
    }

    // Appel des vues
    include (__DIR__.'/../../views/templates/header.php');
    include (__DIR__.'/../../views/admin/leftbar.php');
    include (__DIR__.'/../../views/admin/income.php');
    include (__DIR__.'/../../views/templates/footer.php');
