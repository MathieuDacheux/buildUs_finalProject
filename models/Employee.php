<?php

require_once(__DIR__.'/../helpers/Database.php');
require_once(__DIR__.'/../models/User.php');

class Employee extends User {
    
    private $phone;
    private $income;
    private $adress;
    private $role;
    private $created;

    /**
     * Constructeur 
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $phone
     * @param float $income
     * @param int $created
     * @param string|null $adress
     * @param int $role
     */
    public function __construct (string $firstname, string $lastname, string $email, string $phone, float $income, int $created, string $adress = null, int $role = 2) {
        parent::__construct($firstname, $lastname, $email);
        $this->phone = $phone;
        $this->income = $income;
        $this->adress = $adress;
        $this->role = $role;
        $this->created = $created;
    }

    /**
     * Récupération du téléphone
     * @return string
     */
    public function getPhone () :string {
        return $this->phone;
    }

    /**
     * Récupération du revenu
     * @return float
     */
    public function getIncome () :float {
        return $this->income;
    }

    /**
     * Récupération de l'adresse
     * @return string
     */
    public function getAdress () :string {
        return $this->adress;
    }

    /**
     * Récupération du rôle
     * @return int
     */
    public function getRole () :int {
        return $this->role;
    }

    /**
     * Récupération de l'admin créateur
     * @return int
     */
    public function getCreated () :int {
        return $this->created;
    }

    /************************************** **************************************/
    /*********************************** CREATE **********************************/
    /************************************** **************************************/

    /**
     * Vérification si l'employé existe déjà
     * @return bool
     */
    public function isExist () :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT `phone` FROM `users` WHERE `phone` = :phone AND `Id_role` = 2 AND `created_by` = :created;');
        $query->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
        $query->bindValue(':created', $this->getCreated(), PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result ? true : false;
    }

    /**
     * Création d'un employé
     * @return bool
     */
    public function add () :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('INSERT INTO `users` (firstname, lastname, email, phone, salaries, adress, Id_role, created_by) VALUES (:firstname, :lastname, :email, :phone, :income, :adress, :role, :created) ;');
        $query->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
        $query->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
        $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
        $query->bindValue(':income', $this->getIncome(), PDO::PARAM_STR);
        $query->bindValue(':adress', $this->getAdress(), PDO::PARAM_STR);
        $query->bindValue(':role', $this->getRole(), PDO::PARAM_INT);
        $query->bindValue(':created', $this->getCreated(), PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() > 0 ? true : false;
    }

    /************************************** **************************************/
    /*********************************** READ ************************************/
    /************************************** **************************************/

    /**
     * Récupération de tous les employés
     * @return array
     */
    public static function get (int $idCreator ,int $id = 0) :array {
        $databaseConnection = Database::getConnection();
        if ($id == 0) {
            $sql = 'SELECT `firstname`, `lastname`, `Id_users` FROM `users` WHERE `Id_role` = 2 AND `created_by` = :created';
            $query = $databaseConnection->prepare($sql);
        } else {
            $sql = 'SELECT `firstname`, `lastname`, `Id_users`, `email`, `phone`, `salaries`, `adress` FROM `users` WHERE `Id_role` = 2 AND `created_by` = :created AND `Id_users` = :id';
            $query = $databaseConnection->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
        }
        $query->bindValue(':created', $idCreator, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    /**
     * Vérication de l'existence d'un employé
     * @return bool
     */
    public static function checkId (int $id) : bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT `Id_users` FROM `users` WHERE `Id_users` = :id AND `Id_role` = 2 AND `created_by` = :created ;');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':created', $_SESSION['id'], PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result ? true : false;
    }

    /************************************** **************************************/
    /*********************************** UPDATE **********************************/
    /************************************** **************************************/

    /**
     * Modification d'un employé
     * @return bool
     */
    public function update (int $id) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('UPDATE `users` SET `firstname` = :firstname, `lastname` = :lastname, `email` = :email, `phone` = :phone, `salaries` = :income, `adress` = :adress WHERE `Id_users` = :id ;');
        $query->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
        $query->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
        $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
        $query->bindValue(':income', $this->getIncome(), PDO::PARAM_STR);
        $query->bindValue(':adress', $this->getAdress(), PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() > 0 ? true : false;
    }

    /************************************** **************************************/
    /*********************************** DELETE **********************************/
    /************************************** **************************************/

    /**
     * Suppression d'un employé
     * @return bool
     */
    public static function delete (int $id) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('DELETE FROM `users` WHERE `Id_users` = :id ;');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() > 0 ? true : false;
    }
}