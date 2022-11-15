<?php

require_once(__DIR__.'/../helpers/JWT.php');

class Mail {

    /**
     * Envoi d'un email de confirmation
     * @return bool
     */
    public static function validationAccount ($email, $firstname, $lastname) :bool {
        $to = $email;
        $subject = 'Bienvenue sur BuildUs, votre dashboard est prêt !';
        $message = 'Bonjour '.$firstname.' '.$lastname.',
        Votre compte a bien été créé, il vous faut l\'activer en cliquant sur le lien ci-dessous :
        http://buildus.localhost/connexion?token='.JWT::createToken().' 
        A bientôt sur BuildUs !';
        $headers = 'From: BuildUs < contact@buildus.fr >' . "\r\n" .
        'Reply-To: contact@buildus.fr' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        if (mail($to, $subject, $message, $headers)) {
            $success = true;
        } else {
            $success = false;
        }
        return $success;
    }

    /**
     * Envoi d'un email de réinitialisation de mot de passe
     * @return bool
     */
    public static function resetPassword ($email, $id) :bool {
        $to = $email;
        $subject = 'Réinitialisation de votre mot de passe';
        $message = 'Bonjour,
        Vous avez demandé à réinitialiser votre mot de passe, il vous faut le modifier en cliquant sur le lien ci-dessous :
        http://buildus.localhost/reinitialiser?token='.JWT::createToken($id).'
        A bientôt sur BuildUs !';
        $headers = 'From: BuildUs < contact@buildus.fr >' . "\r\n" .
        'Reply-To: contact@buildus.fr' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        if (mail($to, $subject, $message, $headers)) {
            $success = true;
        } else {
            $success = false;
        }
        return $success;
    }
        
}