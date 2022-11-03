<?php

class Admin extends User {
        
    private $password;
    private $cgu;
    private $newsletter;
    private $role;

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
}