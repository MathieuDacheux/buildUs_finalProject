<?php

require_once(__DIR__.'/../helpers/Database.php');
require_once(__DIR__.'/../models/User.php');

class Client extends User {

    private $phone;
    private $siret;
    private $adress;
    private $role;
    private $created;

    /**
     * Constructeur
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $phone
     * @param string $siret
     * @param int $created
     * @param string|null $adress
     * @param int $role
     */
    public function __construct (string $firstname, string $lastname, string $email, string $phone, string $siret, int $created, string $adress = null, int $role = 3) {
        parent::__construct($firstname, $lastname, $email);
        $this->phone = $phone;
        $this->siret = $siret;
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
     * Récupération du SIRET
     * @return string
     */
    public function getSiret () :string {
        return $this->siret;
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
     * Vérification si le client existe déjà
     * @return bool
     */
    public function isExist () :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT `siret` FROM `users` WHERE `siret` = :siret AND `Id_role` = 3 AND `created_by` = :created ;');
        $query->bindValue(':siret', $this->getSiret(), PDO::PARAM_STR);
        $query->bindValue(':created', $this->getCreated(), PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result ? true : false;
    }

    /**
     * Création d'un client
     * @return bool
     */
    public function add () :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('INSERT INTO `users` (firstname, lastname, email, phone, siret, adress, Id_role, created_by) VALUES (:firstname, :lastname, :email, :phone, :siret, :adress, :role, :created) ;');
        $query->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
        $query->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
        $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
        $query->bindValue(':siret', $this->getSiret(), PDO::PARAM_STR);
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
     * Récupération de tous les clients
     * @return array
     */
    public static function get (int $idCreator ,int $id = 0) :array {
        $databaseConnection = Database::getConnection();
        if ($id == 0) {
            $sql = 'SELECT `firstname`, `lastname`, `Id_users` FROM `users` WHERE `Id_role` = 3 and `created_by` = :created';
            $query = $databaseConnection->prepare($sql);
        } else {
            $sql = 'SELECT `firstname`, `lastname`, `Id_users`, `email`, `phone`, `siret`, `adress` FROM `users` WHERE `Id_role` = 3 and `created_by` = :created AND `Id_users` = :id';
            $query = $databaseConnection->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
        }
        $query->bindValue(':created', $idCreator, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    /**
     * Vérication de l'existence d'un client
     * @return bool
     */
    public static function checkId (int $id) : bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT `Id_users` FROM `users` WHERE `Id_users` = :id AND `Id_role` = 3 AND `created_by` = :created ;');
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
     * Modification d'un client
     * @return bool
     */
    public function update (int $id) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('UPDATE `users` SET `firstname` = :firstname, `lastname` = :lastname, `email` = :email, `phone` = :phone, `siret` = :siret, `adress` = :adress WHERE `Id_users` = :id AND `Id_role` = 3 AND `created_by` = :created ;');
        $query->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
        $query->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
        $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
        $query->bindValue(':siret', $this->getSiret(), PDO::PARAM_STR);
        $query->bindValue(':adress', $this->getAdress(), PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':created', $this->getCreated());
        $query->execute();
        var_dump($query->rowCount());
        return $query->rowCount() > 0 ? true : false;
    }

    /************************************** **************************************/
    /*********************************** DELETE **********************************/
    /************************************** **************************************/

    /**
     * Suppression d'un client
     * @return bool
     */
    public static function delete (int $id) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('DELETE FROM `users` WHERE `Id_users` = :id AND `Id_role` = 3 AND `created_by` = :created ;');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':created', $_SESSION['id'], PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() > 0 ? true : false;
    }
}