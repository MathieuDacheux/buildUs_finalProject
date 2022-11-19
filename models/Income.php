<?php

require_once(__DIR__.'/../helpers/Database.php');

class Income {

    public $amount;
    public $user_id;

    /**
     * Constructeur
     * @param float $amount
     * @param int $user_id
     */
    public function __construct (float $amount, int $user_id) {
        $this->amount = $amount;
        $this->user_id = $user_id;
    }

    /**
     * Récupération du montant
     * @return float
     */
    public function getAmount () :float {
        return $this->amount;
    }

    /**
     * Récupération de l'identifiant de l'utilisateur
     * @return int
     */
    public function getUserId () :int {
        return $this->user_id;
    }

    /************************************** **************************************/
    /*********************************** CREATE **********************************/
    /************************************** **************************************/

    /**
     * Création d'un revenu
     * @param float $amount
     * @param int $user_id
     * @return bool
     */
    public function add () :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('INSERT INTO incomes (daily_income, Id_users) VALUES (:amount, :user_id)');
        $query->bindValue(':amount', $this->getAmount(), PDO::PARAM_STR);
        $query->bindValue(':user_id', $this->getUserId(), PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount() == 1 ? true : false;
    }

    /************************************** **************************************/
    /*********************************** READ ************************************/
    /************************************** **************************************/

    /**
     * Récupération de chaque revenu d'un utilisateur des 7 derniers jours
     * 'SELECT `daily_income`, `income_date` FROM `incomes` WHERE `Id_users` = :id AND `income_date` BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ORDER BY `income_date` DESC'
     * @param int $id
     * @return array
     */
    public static function getSevenDays (int $id) :array {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT `incomes`.`daily_income`, `incomes`.`income_date`, `incomes`.`Id_incomes`, `users`.`target` FROM `incomes` LEFT JOIN `users` ON `incomes`.`Id_users` = `users`.`Id_users` WHERE `incomes`.`Id_users` = :id AND `incomes`.`income_date` BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() ORDER BY `incomes`.`income_date` DESC');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getLastIncome (int $id) :object {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT * FROM `incomes` WHERE `Id_users` = :id ORDER BY `income_date` DESC LIMIT 1');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /************************************** **************************************/
    /********************************** UPDATE ***********************************/
    /************************************** **************************************/

    /**
     * Modification d'un revenu
     * @param int $id
     * @param float $amount
     * @return bool
     */
    public static function update (int $id, float $amount) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('UPDATE incomes SET `daily_income` = :amount WHERE `Id_incomes` = :id');
        $query->bindValue(':amount', $amount, PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return ($query->rowCount() == 1) ? true : false;
    }

    /************************************** **************************************/
    /********************************** DELETE ***********************************/
    /************************************** **************************************/

    /**
     * Suppression d'un revenu
     * @param int $id
     * @return bool
     */
    public function delete (int $id) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('DELETE FROM incomes WHERE id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return ($query->rowCount() == 1) ? true : false;
    }
}