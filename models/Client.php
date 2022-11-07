<?php

require_once(__DIR__.'/../models/User.php');
require_once(__DIR__.'/../helpers/functions.php');

class Client extends User {

    private $phone;
    private $siret;
    private $adress;
    private $role;

    /**
     * @param string $firstname
     * @param string $lastname
     * @param mixed string
     * @param string $phone
     * @param string $siret
     * @param string $adress
     * @param int $role
     */
    public function __construct (string $firstname, string $lastname, string $email, string $phone, string $siret, string $adress = null, int $role = 3) {
        parent::__construct($firstname, $lastname, $email);
        $this->phone = $phone;
        $this->siret = $siret;
        $this->adress = $adress;
        $this->role = $role;
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

    /************************************** **************************************/
    /*********************************** CREATE **********************************/
    /************************************** **************************************/

    /**
     * Vérification si le client existe déjà
     * @return bool
     */
    public function isExist () :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT * FROM clients WHERE siret = :siret ;');
        $query->bindValue(':siret', $this->getSiret(), PDO::PARAM_STR);
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
        $query = $databaseConnection->prepare('INSERT INTO users (firstname, lastname, email, phone, siret, adress, Id_role) VALUES (:firstname, :lastname, :email, :phone, :siret, :adress, :role) ;');
        $query->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $query->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $query->bindValue(':email', $this->email, PDO::PARAM_STR);
        $query->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $query->bindValue(':siret', $this->siret, PDO::PARAM_STR);
        $query->bindValue(':adress', $this->adress, PDO::PARAM_STR);
        $query->bindValue(':role', $this->role, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() > 0 ? true : false;
    }

    /************************************** **************************************/
    /*********************************** READ ************************************/
    /************************************** **************************************/

}