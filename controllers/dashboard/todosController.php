<?php

    // Appel des configurations
    require_once(__DIR__.'/../../config/config.php');
    require_once(__DIR__.'/../../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../../helpers/functions.php');

    // Appel des modèles
    require_once(__DIR__.'/../../models/Admin.php');
    require_once(__DIR__.'/../../models/Todo.php');

    // Variables
    $style ='<link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/leftbar.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/todos.css">
    <link rel="stylesheet" href="/../../public/css/dashboard/rightbar.css">';
    
    $javascript = '<script defer src="../public/js/openNavbar.js"></script>
    <script defer src="../public/js/registrationState.js"></script>
    <script defer src="../public/js/todosContainer.js"></script>';
    
    $title = TITLE_HEAD[12];
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
                // Récupération des tâches
                $tasksUnChecked = Todo::get($created);
                $tasksChecked = Todo::get($created, 1);

                // Actions effectuées si la méthode est en POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Filtrage des données 
                    $description = trim(filter_input(INPUT_POST, 'task', FILTER_SANITIZE_SPECIAL_CHARS));
                    
                    $todo = new Todo($description, $created);
                    if ($todo->add() == true) {
                        $registerConfirmation = true;
                    } else {
                        $registerConfirmation = false;
                    }
                }

                // Actions effectuées si la méthode est en GET
                if (isset($_GET['id'])) {
                    $id = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
                    if (Todo::isExist($id, $created) == true) {
                        if (isset($_GET['delete'])) {
                            $delete = trim(filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_NUMBER_INT));
                            if ($delete == 1) {
                                if (Todo::delete($id, $created) == true) {
                                    $deleteConfirmation = true;
                                } else {
                                    $deleteConfirmation = false;
                                }
                            } else {
                                header('Location: /dashboard/rappels');
                                exit();
                            }
                        } else if (isset($_GET['checked'])) {
                            $checked = trim(filter_input(INPUT_GET, 'checked', FILTER_SANITIZE_NUMBER_INT));
                            if ($checked == 1) {
                                if (Todo::updateChecked($id, $created) == true) {
                                    $checkedConfirmation = true;
                                } else {
                                    $checkedConfirmation = false;
                                }
                            } else {
                                header('Location: /dashboard/rappels');
                                exit();
                            }
                        }
                    }
                }
            }
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
    include (__DIR__.'/../../views/admin/todos.php');
    include (__DIR__.'/../../views/admin/rightbar.php');
    include (__DIR__.'/../../views/templates/footer.php');

