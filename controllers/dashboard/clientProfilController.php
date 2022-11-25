<?php

    // Appel des configurations
    require_once(__DIR__.'/../../config/config.php');
    require_once(__DIR__.'/../../config/regex.php');

    // Appel des fonctions
    require_once(__DIR__.'/../../helpers/functions.php');

    // Appel du modèle
    require_once(__DIR__.'/../../models/Admin.php');
    require_once(__DIR__.'/../../models/Client.php');
    require_once(__DIR__.'/../../models/Invoice.php');

    
    // Variables
    $javascript = '<script defer src="../public/js/openNavbar.js"></script>
    <script defer src="../public/js/invoiceState.js"></script>
    <script defer src="../public/js/deleteProfil.js"></script>';
    
    $title = TITLE_HEAD[9];
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
    
                // Action effectuée si la méthode est en GET et si l'id est présent
                if (isset($_GET['id'])) {
                    // Nettage de l'id
                    $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
                    // Vérification de l'id
                    if (validationInput($id, REGEX_ID) == 'true' && Client::checkId($id) == true) {
                        // Récupération des informations de l'employé
                        $client = Client::get($created, $id);
                        $invoicesDisplay = Invoice::get($id);

                        // Action effectué si la méthode est en POST
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            // Filtrage de la donnée
                            $bills = $_FILES['bills'];
                            // Emplacement de stockage des fichiers uploadés
                            $targetDirection =  $_SERVER['DOCUMENT_ROOT'].'/public/uploads/'.$id.'/';
                            
                            // Vérification si le fichier est bien uploadé sans erreur
                            if (isset($_FILES['bills']) && $_FILES['bills']['error'] == 0) {
                                // Nom du fichier
                                $fileInfo = pathinfo($bills['name']);
                                // Récupération de l'extension du fichier
                                $fileExtension = $fileInfo['extension'];
                                // Récupération du nom du fichier
                                $fileInfo['filename'] = str_replace(' ', '_', $fileInfo['filename']);
                                $fileName = $fileInfo['filename'];
                                // Extension autorisée
                                $extensionAllowed = 'pdf';
                                // Si le dossier n'existe pas, on le crée
                                if (!file_exists($targetDirection)) {
                                    mkdir($targetDirection, 0777, true);
                                }
                                // Vérification de l'extension
                                if($fileExtension == $extensionAllowed) {
                                    // Vérication de la taille du fichier
                                    if ($bills['size'] <= 5000000) {
                                        // Déplacement du fichier
                                        if (move_uploaded_file($bills['tmp_name'], $targetDirection.$fileName.'.'.$fileExtension)) {
                                            // Instanciation de la classe Invoice
                                            $invoice = new Invoice($fileName, $id);
                                            if ($invoice->add() == true) {
                                                $success = 'Le document a bien été ajouté';
                                            }
                                        } else {
                                            $error = 'Le fichier n\'a pas pu être déplacé';
                                        }
                                    } else {
                                        $error = 'Le fichier est trop volumineux';
                                    }
                                } else {
                                    $error = 'L\'extension du fichier n\'est pas autorisée';
                                }
                            } else {
                                $error = 'Une erreur est survenue lors de l\'upload du fichier';
                            }

                        }
                        // Action effectuée si la méthode est en GET et si id PDF est présent
                        if (isset($_GET['pdf'])) {
                            $idPDF = intval(trim(filter_input(INPUT_GET, 'pdf', FILTER_SANITIZE_NUMBER_INT)));
                            if (Invoice::isExist($idPDF, $id) == true) {
                                unlink($_SERVER['DOCUMENT_ROOT'].'/public/uploads/'.$id.'/'.Invoice::getOne($idPDF, $id).'.pdf');
                                Invoice::delete($idPDF, $id);
                                header('Location: /dashboard/profil-client?id='.$id);
                                exit();
                            } else {
                                header('Location: /dashboard/profil-client?id='.$id);
                                exit();
                            }
                        }
                    } else {
                        header('Location: /dashboard/clients');
                        exit();
                    }
                }
    
                // Action effectuée si la méthode est en POST et si modify est présent
                if (isset($_GET['modify'])) {
                    if ($_GET['modify'] == 'true' && $_SERVER['REQUEST_METHOD'] == 'POST') {
                        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
                        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
                        $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
                        $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
                        $siret = trim(filter_input(INPUT_POST, 'siret', FILTER_SANITIZE_NUMBER_INT));
                        $adress = trim(filter_input(INPUT_POST, 'adress', FILTER_SANITIZE_SPECIAL_CHARS));
                        
                        // Validationd des inputs
                        if (validationInput($lastname, REGEX_NAME) != true) {
                            $errorsModify['lastname'] = validationInput($lastname, REGEX_NAME);
                        }
                        if (validationInput($firstname, REGEX_NAME) != true) {
                            $errorsModify['firstname'] = validationInput($firstname, REGEX_NAME);
                        }
                        if (validationInput($mail, REGEX_MAIL) != true) {
                            $errorsModify['mail'] = validationInput($mail, REGEX_MAIL);
                        }
                        if (validationInput($phone, REGEX_PHONE) != true) {
                            $errorsModify['phone'] = validationInput($phone, REGEX_PHONE);
                        }
                        if (validationInput($siret, REGEX_INCOME) != true) {
                            $errorsModify['siret'] = validationInput($income, REGEX_INCOME);
                        }
                        // Si tableau d'erreurs vide
                        if (empty($errorsModify)) {
                            // Instanciation de l'objet Employee
                            $client = new Client($lastname, $firstname, $mail, $phone, $siret, $created, $adress);
                            
                            // Modification de l'employé
                            $client->update($id);
                            header('Location: /dashboard/profil-client?id='.$id);
                            exit();
                        } else {
                            header('Location: /dashboard/client');
                            exit();
                        }
                    }
                }
                
                // Action effectuée si la méthode est en GET et si delete est présent
                if (isset($_GET['delete'])) {
                    if ($_GET['delete'] == 'true') {
                        if (Client::checkId($id) == true) {
                            if (file_exists($_SERVER['DOCUMENT_ROOT'].'/public/uploads/'.$id)) {
                                $files = scandir($_SERVER['DOCUMENT_ROOT'].'/public/uploads/'.$id);
                                foreach ($files as $file) {
                                    if ($file != '.' && $file != '..') {
                                        unlink($_SERVER['DOCUMENT_ROOT'].'/public/uploads/'.$id.'/'.$file);
                                    }
                                }
                                rmdir($_SERVER['DOCUMENT_ROOT'].'/public/uploads/'.$id);
                            }
                            Client::delete($id);
                            header('Location: /dashboard/clients');
                        } else {
                            header('Location: /dashboard/clients');
                            exit();
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
    if (isset($_GET['modify']) == 'true') {
        $style = '<link rel="stylesheet" href="../public/css/main.css">
        <link rel="stylesheet" href="/../../public/css/dashboard/leftbar.css">
        <link rel="stylesheet" href="/../../public/css/dashboard/modify.css">';
        include (__DIR__.'/../../views/templates/header.php');
        include (__DIR__.'/../../views/admin/leftbar.php');
        include (__DIR__.'/../../views/admin/clientModify.php');
    } else {
        $style = '<link rel="stylesheet" href="../public/css/main.css">
        <link rel="stylesheet" href="/../../public/css/dashboard/leftbar.css">
        <link rel="stylesheet" href="/../../public/css/dashboard/profil.css">';
        include (__DIR__.'/../../views/templates/header.php');
        include (__DIR__.'/../../views/admin/leftbar.php');
        include (__DIR__.'/../../views/admin/clientProfil.php');
    }
    
    include (__DIR__.'/../../views/templates/footer.php');