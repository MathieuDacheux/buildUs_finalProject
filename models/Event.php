<?php

require_once(__DIR__.'/../helpers/Database.php');

class Event {

    private string $title;
    private string $start_at;
    private string $end_at;
    private bool $allDay;
    private int $created;
    
    /**
     * @param string $title
     * @param string $start_at
     * @param string $end_at
     * @param bool $allDay
     * @param int $created
     */
    public function __construct (string $title, string $start_at, string $end_at, bool $allDay, int $created) {
        $this->title = $title;
        $this->start_at = $start_at;
        $this->end_at = $end_at;
        $this->allDay = $allDay;
        $this->created = $created;
    }

    /**
     * Retourne le titre de l'événement
     * @return string
     */
    public function getTittle () : string {
        return $this->title;
    }

    /**
     * Retourne la date de début de l'événement
     * @return string
     */
    public function getStart_at () :string {
        return $this->start_at;
    }

    /**
     * Retourne la date de fin de l'événement
     * @return string
     */
    public function getEnd_at () :string {
        return $this->end_at;
    }

    /**
     * Retourne si l'événement est sur toute la journée
     * @return bool
     */
    public function getAllDay () :bool {
        return $this->allDay;
    }

    /**
     * Retourne l'ID du créateur de l'événement
     * @return int
     */
    public function getIdAuthor () :int {
        return $this->created;
    }

    /********************************* *********************************/
    /***************************** CREATE ******************************/
    /********************************* *********************************/

    public static function isExist (int $id) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT * FROM `events` WHERE `Id_events` = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result ? true : false;
    }

    public function add () :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('INSERT INTO `events` (title, start_at, end_at, all_day, Id_users) VALUES (:title, :start_at, :end_at, :allDay, :created)');
        $query->bindValue(':title', $this->title, PDO::PARAM_STR);
        $query->bindValue(':start_at', $this->start_at, PDO::PARAM_STR);
        $query->bindValue(':end_at', $this->end_at, PDO::PARAM_STR);
        $query->bindValue(':allDay', $this->allDay, PDO::PARAM_BOOL);
        $query->bindValue(':created', $this->created, PDO::PARAM_INT);
        return $query->execute();
    }

    /********************************* *********************************/
    /***************************** READ ********************************/
    /********************************* *********************************/

    public static function get ($created) :array {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT `Id_events`, `title`, `start_at`, `end_at`, `all_day` FROM `events` WHERE `Id_users` = :created');
        $query->bindValue(':created', $created, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /********************************* *********************************/
    /***************************** UPDATE ******************************/
    /********************************* *********************************/

    /********************************* *********************************/
    /***************************** DELETE ******************************/
    /********************************* *********************************/

    public static function delete ($id) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('DELETE FROM `events` WHERE `Id_events` = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }
}