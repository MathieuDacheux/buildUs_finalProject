<?php

class Admin extends User {
        
    private $password;
    private $cgu;
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
    public function __construct(string $firstname = 'firstname', string $lastname = 'lastname', string $email = 'email', string $password = 'password', bool $cgu = false, bool $newsletter = false) {
        parent::__construct($firstname, $lastname, $email);
        $this->password = $password;
        $this->cgu = $cgu;
        $this->newsletter = $newsletter;
        $this->role = 1;
    }

    /**
     * Récupération du mot de passe
     * @return string
     */
    public function getPassword() :string {
        return $this->password;
    }

    /**
     * Récupération des CGU
     * @return bool
     */
    public function getCgu() :bool {
        return $this->cgu;
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

    public function add () :bool {
        try {
            $databaseConnection = Database::getConnection();
            $query = $databaseConnection->prepare('INSERT INTO users (firstname, lastname, email, password, cgu, newsletter, role) VALUES (:firstname, :lastname, :email, :password, :cgu, :newsletter, :role)');
            $query->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
            $query->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->bindValue(':password', $this->getPassword(), PDO::PARAM_STR);
            $query->bindValue(':cgu', $this->getCgu(), PDO::PARAM_BOOL);
            $query->bindValue(':newsletter', $this->getNewsletter(), PDO::PARAM_BOOL);
            $query->bindValue(':role', $this->getRole(), PDO::PARAM_INT);
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
    /*********************************** READ ************************************/
    /************************************** **************************************/

    public static function getAll () :array {
        try {
            $databaseConnection = Database::getConnection();
            $query = $databaseConnection->prepare('SELECT * FROM users');
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);
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

    public function update ($id) :bool {
        try {
            $databaseConnection = Database::getConnection();
            $query = $databaseConnection->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password WHERE id = :id');
            $query->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
            $query->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->bindValue(':password', $this->getPassword(), PDO::PARAM_STR);
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

    public static function delete ($id) :bool {
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