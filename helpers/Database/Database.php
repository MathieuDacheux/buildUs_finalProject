<?php

class Database {
    
    private $connection;
    private $host = HOST;
    private $db_name = DB_NAME;
    private $username = USERNAME;
    private $password = PASSWORD;
    private static $instance = null;
    
    // Constructeur
    private function __construct() {
        $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
    }
    
    /**
     * Instanciation de la Database si elle n'existe pas
     * @return Database
     */
    public static function getInstance() :Database {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    /**
     * Récupération de la connexion à la base de données
     * @return PDO
     */
    public function getConnection() :PDO {
        return $this->connection;
    }
}