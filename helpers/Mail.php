<?php

require_once(__DIR__.'/../helpers/JWT.php');

class Mail {

    /**
     * Envoi d'un email de confirmation
     * @return bool
     */
    public static function validationAccount (string $email, string $firstname, string $lastname) :bool {
        $to = $email;
        $domain = $_SERVER['HTTP_HOST'];
        var_dump($domain);
        $subject = 'Bienvenue sur BuildUs, votre dashboard est prêt !';
        $message = 'Bonjour '.$firstname.' '.$lastname.',
        Votre compte a bien été créé, il vous faut l\'activer en cliquant sur le lien ci-dessous : '.$_SERVER['HTTP_ORIGIN'].'/connexion?token='.JWT::createToken().' 
        A bientôt sur BuildUs !';
        $headers = 'From: BuildUs < contact@buildus.fr >' . "\r\n" .
        'Reply-To: contact@buildus.fr' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        return (mail($to, $subject, $message, $headers)) ? true : false;
    }

    /**
     * Envoi d'un email de réinitialisation de mot de passe
     * @return bool
     */
    public static function resetPassword (string $email, int $id) :bool {
        $to = $email;
        // Use the current url to get the domain name
        
        $subject = 'Réinitialisation de votre mot de passe';
        $message = 'Bonjour,
        Vous avez demandé à réinitialiser votre mot de passe, il vous faut le modifier en cliquant sur le lien ci-dessous : '.$_SERVER['HTTP_ORIGIN'].'/reinitialiser?token='.JWT::createToken($id).'
        A bientôt sur BuildUs !';
        $headers = 'From: BuildUs < contact@buildus.fr >' . "\r\n" .
        'Reply-To: contact@buildus.fr' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        return (mail($to, $subject, $message, $headers)) ? true : false;
    }

    public static function sendInvoice (string $email, string $url, int $id) :bool {
        $to = $email;
        $token = JWT::createToken($id);
        $link = $_SERVER['HTTP_ORIGIN'].'/download?token='.$token.'&'.'file='.$url;
        $subject = 'Votre facture BuildUs';
        $message = 'Bonjour, 
        Vous trouverez ci-joint votre facture BuildUs : '.$link.'
        A bientôt sur BuildUs !';
        $header = 'From: BuildUs < contact@buildus.fr >' . "\r\n" .
        'Reply-To: contact@buildus.fr' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        return (mail($to, $subject, $message, $header)) ? true : false;
    }
    
}