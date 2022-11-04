<?php

class Client extends User {

    private $phone;
    private $siret;
    private $adress;

    /**
     * Constructeur
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $phone
     * @param string $siret
     * @param string $adress
     */
    public function __construct (string $firstname, string $lastname, string $email = 'Non définie', string $phone, string $siret, string $adress) {
        parent::__construct($firstname, $lastname, $email);
        $this->phone = $phone;
        $this->siret = $siret;
        $this->adress = $adress;
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

    /************************************** **************************************/
    /*********************************** CREATE **********************************/
    /************************************** **************************************/

    public function add () :bool {
        try {
            $databaseConnection = Database::getConnection();
            $query = $databaseConnection->prepare('INSERT INTO users (firstname, lastname, email, phone, siret, adress) VALUES (:firstname, :lastname, :email, :phone, :siret, :adress)');
            $query->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
            $query->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
            $query->bindValue(':email', $this->email, PDO::PARAM_STR);
            $query->bindValue(':phone', $this->phone, PDO::PARAM_STR);
            $query->bindValue(':siret', $this->siret, PDO::PARAM_STR);
            $query->bindValue(':adress', $this->adress, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /************************************** **************************************/
    /*********************************** READ ************************************/
    /************************************** **************************************/

    public static function getAll () :array {
        try {
            $databaseConnection = Database::getConnection();
            $query = $databaseConnection->prepare('SELECT * FROM users');
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($result == false) {
                return [];
            } else {
                return $result;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /************************************** **************************************/
    /********************************** UPDATE ***********************************/
    /************************************** **************************************/

    public function update (int $id) :bool {
        try {
            $databaseConnection = Database::getConnection();
            $query = $databaseConnection->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, phone = :phone, siret = :siret, adress = :adress WHERE id = :id');
            $query->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
            $query->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
            $query->bindValue(':email', $this->email, PDO::PARAM_STR);
            $query->bindValue(':phone', $this->phone, PDO::PARAM_STR);
            $query->bindValue(':siret', $this->siret, PDO::PARAM_STR);
            $query->bindValue(':adress', $this->adress, PDO::PARAM_STR);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            if ($query->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /************************************** **************************************/
    /********************************** DELETE ***********************************/
    /************************************** **************************************/

    public static function delete (int $id) :bool {
        try {
            $databaseConnection = Database::getConnection();
            $query = $databaseConnection->prepare('DELETE FROM users WHERE id = :id');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            if ($query->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}