<?php

require_once(__DIR__.'/../helpers/Database.php');
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

    /************************************** **************************************/
    /*********************************** READ ************************************/
    /************************************** **************************************/
    
    public static function getId (string $email) :int {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT `Id_users` FROM `users` WHERE `email` = :email and `Id_role` = 1');
        $query->bindValue(':email', $email, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result->Id_users;
    }

    public static function getOne () :array {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT `Id_users`, `firstname`, `lastname`, `email` FROM `users` WHERE `Id_users` = :id AND `Id_role` = 1');
        $query->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    /************************************** **************************************/
    /********************************** UPDATE ***********************************/
    /************************************** **************************************/

    public static function update (string $firstname, string $lastname, string $email, int $id) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('UPDATE `users` SET `firstname` = :firstname, `lastname` = :lastname, `email` = :email WHERE `Id_users` = :id AND `Id_role` = 1 ;');
        $query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $query->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
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