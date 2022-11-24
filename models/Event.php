<?php

require_once(__DIR__.'/../helpers/Database.php');

class Event {

    private int $id;
    private string $start_at;
    private string|null $end_at;
    private string|null $description;

    /**
     * Constructeur
     * @param int $id
     * @param string $start_at
     * @param string|null $end_at
     * @param int|null $description
     */
    public function __construct (int $id, string $start_at, string $end_at = null, int $description = null) {
        $this->id = $id;
        $this->start_at = $start_at;
        $this->end_at = $end_at;
        $this->description = $description;
    }

    /**
     * Retourne l'ID de l'utilisateur qui a crée l'évènement
     * @return int
     */
    public function getId () : int {
        return $this->id;
    }

    /**
     * Retourne la date de début de l'évènement
     * @return string
     */
    public function getStartAt () : string {
        return $this->start_at;
    }

    /**
     * Retourne la date de fin de l'évènement
     * @return string
     */
    public function getEndAt () : string {
        return $this->end_at;
    }

    /**
     * Retourne la description de l'évènement
     * @return int
     */
    public function getDescription () : int {
        return $this->description;
    }

    /****************************** ******************************/
    /*************************** CREATE **************************/
    /****************************** ******************************/

    public function add () : bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->query('INSERT INTO `events` (`start_at`, `end_at`, `description`, `Id_users` ) VALUES (:start_at, :end_at, :description, :id) ;');
        $query->bindValue(':start_at', $this->getStartAt(), PDO::PARAM_STR);
        $query->bindValue(':end_at', $this->getEndAt(), PDO::PARAM_STR);
        $query->bindValue(':description', $this->getDescription(), PDO::PARAM_STR);
        $query->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        return $query->execute();
    }

    /****************************** ******************************/
    /*************************** READ ***************************/
    /****************************** ******************************/

    public static function get (int $id) : array {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->query('SELECT * FROM `events` WHERE `Id_users` = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}