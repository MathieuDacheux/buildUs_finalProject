<?php

    // Appel des configurations
    require_once(__DIR__.'/../../config/config.php');

    // Appel des fonctions
    require_once(__DIR__.'/../../helpers/functions.php');

    // Appel des modèles
    require_once(__DIR__.'/../../models/Invoice.php');
    require_once(__DIR__.'/../../models/Admin.php');
    require_once(__DIR__.'/../../helpers/JWT.php');
    
    if (isset($_GET['token']) && isset($_GET['file'])) {
        $token = $_GET['token'];
        $file = trim(filter_input(INPUT_GET, 'file', FILTER_SANITIZE_SPECIAL_CHARS));
        $decoded = JWT::decodeToken($token);
        if (Invoice::isExist($decoded, 0, 1)) {
            $invoice = Invoice::isExist($decoded, 0, 1);
            $link = $_SERVER['DOCUMENT_ROOT'].'/public/uploads/'.$invoice->Id_users.'/'.$invoice->url.'.pdf';
            if (file_exists($link)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($file).'.pdf"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($link));
                readfile($link);
                exit;
            }
        }
    }


