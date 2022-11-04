<?php

class User {
    
    protected $firstname;
    protected $lastname;
    protected $email;

    /**
     * Constructeur
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     */
    public function __construct(string $firstname = 'firstname', string $lastname = 'lastname', string $email = 'email') {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
    }

    /**
     * Récupération du prénom
     * @return string
     */
    public function getFirstname() :string {
        return $this->firstname;
    }

    /**
     * Récupération du nom
     * @return string
     */
    public function getLastname() :string {
        return $this->lastname;
    }

    /**
     * Réupération de l'email
     * @return string
     */
    public function getEmail() :string {
        return $this->email;
    }
}