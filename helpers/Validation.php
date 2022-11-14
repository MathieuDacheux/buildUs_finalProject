<?php

class Validation {

    /**
     * Validation de l'inscription
     * @param int $id
     * 
     * @return bool
     */
    public static function account (int $id) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT `Id_users` FROM `users` WHERE `Id_users` = :id AND Id_role = 1');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() == 1) {
            $query = $databaseConnection->prepare('UPDATE `users` SET `activated_at` = CURRENT_TIMESTAMP WHERE `Id_users` = :id AND Id_role = 1');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            if ($query->rowCount() == 1) {
                $success = true;
            } else {
                $success = false;
            }
        } else {
            $success = false;
        }
        return $success;
    }

    /**
     * Comparaison du mot de passe entré dans le formulaire avec celui de la base de données en fonction de l'email
     * @param string $email
     * @param string $password
     * 
     * @return bool
     */
    public static function login (string $email, string $password) :bool {
        $databaseConnection = Database::getConnection();
        $query = $databaseConnection->prepare('SELECT `password` FROM `users` WHERE `email` = :email AND `Id_role` = 1 ;');
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        if (password_verify($password, $result->password) == true) {
            $success = true;
        } else {
            $success = false;
        }
        return $success;
    }

}