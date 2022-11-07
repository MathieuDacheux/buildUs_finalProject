<?php

require_once(__DIR__.'/../helpers/DataBase/Database.php');
require_once(__DIR__.'/../models/User.php');

class Admin extends User {
        
    private $password;
    private $newsletter;
    private $role;

    /**
     * Constructeur
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $password
     * @param bool $cgu
     * @param bool $newsletter
     */
    public function __construct(string $firstname, string $lastname, string $email, string $password, bool $newsletter = false, int $role = 1) {
        parent::__construct($firstname, $lastname, $email);
        $this->password =  password_hash($password, PASSWORD_BCRYPT);
        $this->newsletter = $newsletter;
        $this->role = $role;
    }

    /**
     * Récupération du mot de passe
     * @return string
     */
    public function getPassword() :string {
        return $this->password;
    }

    /**
     * Récupération de la newsletter
     * @return bool
     */
    public function getNewsletter() :bool {
        return $this->newsletter;
    }

    /**
     * Récupération du rôle
     * @return int
     */
    public function getRole() :int {
        return $this->role;
    }

    /************************************** **************************************/
    /*********************************** CREATE **********************************/
    /************************************** **************************************/

    /**
     * Vérification si l'email existe déjà
     * @return bool
     */
    public function isExist () :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT * FROM users WHERE email = :email');
        $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Création d'un nouvel utilisateur
     * @return bool
     */
    public function add () :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('INSERT INTO users (firstname, lastname, email, password, newsletter, Id_role) VALUES (:firstname, :lastname, :email, :password, :newsletter, :role)');
        $query->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
        $query->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
        $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':password', $this->getPassword(), PDO::PARAM_STR);
        $query->bindValue(':newsletter', $this->getNewsletter(), PDO::PARAM_BOOL);
        $query->bindValue(':role', $this->getRole(), PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() >= 1) {
            $success = true;
        } else {
            $success = false;
        }
        return $success;
    }

    /**
     * Création d'un token
     * @return string
     */
    public static function createToken () :string {
        $databaseConnection = Database::getConnection();
        // Création de l'entête du token
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        // Création du payload du token
        $payload = json_encode(['Id_user' => $databaseConnection->lastInsertId()]);
        // Encodage de l'entête du token en base 64
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        // Encodage du payload du token en base 64
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        // Signature du token
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);
        // Encodage de la signature du token en base 64
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        // Création du token
        $jwt = $base64UrlHeader.'.'.$base64UrlPayload.'.'.$base64UrlSignature;
        return $jwt;
    }

    /**
     * Envoi d'un email de confirmation
     * @return bool
     */
    public function sendEmail () :bool {
        $to = $this->getEmail();
        $subject = 'Bienvenue sur BuildUs, votre dashboard est prêt !';
        $message = 'Bonjour '.$this->getFirstname().' '.$this->getLastname().',
        Votre compte a bien été créé, il vous faut l\'activer en cliquant sur le lien ci-dessous :
        http://buildus.localhost/connexion?token='.Admin::createToken().' 
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
     * Décodage du token
     * @param string $token
     * 
     * @return int
     */
    public static function decodeToken (string $token) :int {
        // Séparation du token en 3 parties
        $tokenParts = explode('.', $token);
        // Récupération de la signature du token
        $tokenSignatureProvided = $tokenParts[2];
        // Génération d'une clé de hashage du header et du payload
        $signature = hash_hmac('sha256', $tokenParts[0] . "." . $tokenParts[1], 'abC123!', true);
        // Encodage de la signature du token en base 64
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        // Vérification de la signature du token
        if ($base64UrlSignature === $tokenSignatureProvided) {
            $payload = json_decode(base64_decode($tokenParts[1]), true);
            return intval($payload['Id_user'], 10);
        } 
    }

    /**
     * Validation de l'inscription
     * @param int $id
     * 
     * @return bool
     */
    public static function validationAccount (int $id) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT `Id_users` FROM `users` WHERE `Id_users` = :id AND Id_role = 1');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() == 1) {
            $query = $databaseConnection->prepare('UPDATE `users` SET `activated_at` = CURRENT_TIMESTAMP WHERE `Id_users` = :id AND Id_role = 1');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            if ($query->rowCount() == 1) {
                $success = true;
            } else {
                $success = false;
            }
        } else {
            $success = false;
        }
        return $success;
    }

    // Compare le mot de passe saisi avec celui de la base de données
    public static function connexion (string $email, string $password) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT `password` FROM `users` WHERE `email` = :email');
        $query->bindValue(':email', $email, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        if (password_verify($password, $result->password) == true) {
            $success = true;
        } else {
            $success = false;
        }
        return $success;
    }

    /************************************** **************************************/
    /*********************************** READ ************************************/
    /************************************** **************************************/

    public static function getAll () :array {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT * FROM users');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        if ($result == false) {
            return [];
        } else {
            return $result;
        }
    }

    /************************************** **************************************/
    /********************************** UPDATE ***********************************/
    /************************************** **************************************/

    public function update (int $id) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password WHERE id = :id');
        $query->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
        $query->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
        $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':password', $this->getPassword(), PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /************************************** **************************************/
    /********************************** DELETE ***********************************/
    /************************************** **************************************/

    public static function delete (int $id) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('DELETE FROM users WHERE id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

}