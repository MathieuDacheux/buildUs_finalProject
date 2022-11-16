<?php

require_once(__DIR__.'/../helpers/Database.php');

class Todo {

    protected $checked;
    protected $description;
    protected $idAuthor;

    /**
     * Constructeur
     * @param string $description
     * @param bool $checked
     */
    public function __construct(string $description, int $idAuthor, bool $checked = false) {
        $this->description = $description;
        $this->idAuthor = $idAuthor;
        $this->checked = $checked;
    }

    /**
     * Retourne la description de la tâche
     * @return string
     */
    public function getDescription() :string {
        return $this->description;
    }

    /**
     * Retourne l'id de l'auteur de la tâche
     * @return int
     */
    public function getIdAuthor() :int {
        return $this->idAuthor;
    }

    /**
     * Retourne l'état de la tâche
     * @return bool
     */
    public function getChecked() :bool {
        return $this->checked;
    }

    /************************************** **************************************/
    /*********************************** CREATE **********************************/
    /************************************** **************************************/

    /**
     * Vérifie si la tâche existe
     * @param int $id
     * @param int $creator
     * 
     * @return bool
     */
    public static function isExist (int $id, int $creator) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT * FROM `todos` WHERE `Id_todos` = :id AND `Id_users` = :idUser');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':idUser', $creator, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Création d'une tâche
     * @param string $description
     * @param int $idAuthor
     * @return bool
     */
    public function add () :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('INSERT INTO `todos` (checked, description, Id_users) VALUES (:checked , :description, :idAuthor) ;');
        $query->bindValue(':checked', $this->getChecked(), PDO::PARAM_BOOL);
        $query->bindValue(':description', $this->getDescription(), PDO::PARAM_STR);
        $query->bindValue(':idAuthor', $this->getIdAuthor(), PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() == 1 ? true : false;
    }

    /************************************** **************************************/
    /*********************************** READ ************************************/
    /************************************** **************************************/

    /**
     * Récupération de toutes les tâches
     * @return array
     */
    public static function get (int $idAuthor, int $id = 0) :array {
        $databaseConnection = Database::getConnection();
        if ($id == 0) {
            $query = $databaseConnection->prepare('SELECT * FROM `todos` WHERE `Id_users` = :idAuthor AND `checked` = false ORDER BY `Id_todos` DESC;');
            $query->bindValue(':idAuthor', $idAuthor, PDO::PARAM_INT);
        } else if ($id == 1) {
            $query = $databaseConnection->prepare('SELECT * FROM `todos` WHERE `Id_users` = :idAuthor AND `checked` = true ORDER BY `Id_todos` DESC;');
            $query->bindValue(':idAuthor', $idAuthor, PDO::PARAM_INT);
        }
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    /************************************** **************************************/
    /*********************************** UPDATE **********************************/
    /************************************** **************************************/

    public static function updateChecked (int $id, int $creator) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('UPDATE `todos` SET `checked` = true, `finished_at` = CURRENT_TIMESTAMP WHERE `Id_todos` = :id AND `Id_users` = :idUser;');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':idUser', $creator, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() == 1 ? true : false;
    }

    /************************************** **************************************/
    /*********************************** DELETE **********************************/
    /************************************** **************************************/

    /**
     * Suppression d'une tâche
     * @param int $id
     * @param int $idAuthor
     * 
     * @return bool
     */
    public static function delete (int $id, int $idAuthor) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('DELETE FROM `todos` WHERE `Id_todos` = :id AND `Id_users` = :idAuthor;');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':idAuthor', $idAuthor, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() == 1 ? true : false;
    }
}