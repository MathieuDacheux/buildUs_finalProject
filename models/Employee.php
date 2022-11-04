<?php

class Employee extends User {
    
    private $phone;
    private $income;
    private $adress;

    /**
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $phone
     * @param string $income
     * @param string $adress
     */
    public function __construct (string $firstname, string $lastname, string $email = 'Non définie', string $phone, float $income, string $adress) {
        parent::__construct($firstname, $lastname, $email);
        $this->phone = $phone;
        $this->income = $income;
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
     * Récupération du revenu
     * @return float
     */
    public function getIncome () :float {
        return $this->income;
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

    
}