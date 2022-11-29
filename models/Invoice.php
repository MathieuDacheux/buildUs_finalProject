<?php

require_once(__DIR__.'/../helpers/Database.php');

class Invoice {
    
    private string $url;
    private int $id;

    /**
     * Constructeur
     * @param string $url
     * @param int $id
     */
    public function __construct(string $url, int $id,) {
        $this->url = $url;
        $this->id = $id;
    }

    /**
     * Récupèration de l'url
     * @return string
     */
    public function getUrl () :string {
        return $this->url;
    }

    /**
     * Récupèration de l'id
     * @return int
     */
    public function getId () :int {
        return $this->id;
    }

    /************************************** **************************************/
    /*********************************** CREATE **********************************/
    /************************************** **************************************/

    /**
     * Vériier si le PDF existe
     * @param int $id
     * @param int $idCreator
     * 
     * @return object
     */
    public static function isExist (int $id, int $idCreator = 0, int $which = 0) :object {
        $databaseConnection = Database::getConnection();
        if ($which == 0 && $idCreator != 0) {
            $query = $databaseConnection->prepare('SELECT * FROM `invoices` WHERE `Id_bills` = :id AND `Id_users` = :idCreator');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':idCreator', $idCreator, PDO::PARAM_INT);
        } else {
            $query = $databaseConnection->prepare('SELECT * FROM `invoices` WHERE `Id_bills` = :id ;');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
        }
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Ajout d'un document PDF
     * @return bool
     */
    public function add () :bool{
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('INSERT INTO `invoices` (`url`, `Id_users`) VALUES (:url, :id_user);');
        $query->bindValue(':url', $this->url, PDO::PARAM_STR);
        $query->bindValue(':id_user', $this->id, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() == 1 ? true : false;
    }
    
    /************************************** **************************************/
    /************************************ READ ***********************************/
    /************************************** **************************************/

    /**
     * Récupèration de tous les documents PDF d'un ID en particulier
     * @param int $id
     * 
     * @return array
     */
    public static function get (int $id) :array {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT * FROM `invoices` WHERE `Id_users` = :id ;');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public static function getOne (int $id) {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT `url` FROM `invoices` WHERE `Id_bills` = :id ;');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result->url;
    }

    /************************************** **************************************/
    /*********************************** UPDATE **********************************/
    /************************************** **************************************/

    public static function update (int $id, string $url, int $state) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('UPDATE `invoices` SET `state` = :state WHERE `Id_users` = :id AND `url` = :url ;');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':url', $url, PDO::PARAM_STR);
        $query->bindValue(':state', $state, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() == 1 ? true : false;
    }

    /************************************** **************************************/
    /*********************************** DELETE **********************************/
    /************************************** **************************************/

    public static function delete (int $id, int $idCreator) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('DELETE FROM `invoices` WHERE `Id_bills` = :id ; AND `Id_users` = :id_user;');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':id_user', $idCreator, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() == 1 ? true : false;
    }
}