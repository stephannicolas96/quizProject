<?php

include_once path::getDatabase();

class user extends database {

    public $id = null;
    public $username = null;
    public $mail = null;
    public $password = null;
    public $confirmPassword = null;
    public $hashedPassword = null;
    public $image = null;
    public $color = null;
    private $colors = ['F9D400', '4ED37C', '00C7FF', 'DC00FF'];

    /**
     * Ajoute un utilisateur à la base de donnée
     */

    public function addUser() {
        $returnValue = -2;
        if (preg_match(regex::getPrefix(), $this->prefix)) {
            $userTable = $this->prefix . 'user';
            $addUserToDB = $this->db->prepare('INSERT INTO `' . $userTable . '` (`mail`, `password`, `username`, `color`) '
                    . 'VALUES (LCASE(:mail), :password, CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2)), :color)');

            $addUserToDB->bindValue(':mail', $this->mail, PDO::PARAM_STR);
            $addUserToDB->bindValue(':password', $this->hashedPassword, PDO::PARAM_STR);
            $addUserToDB->bindValue(':username', $this->username, PDO::PARAM_STR);
            $addUserToDB->bindValue(':color', $this->colors[rand(0, count($this->colors) - 1)], PDO::PARAM_STR);

            if ($addUserToDB->execute()) {
                $returnValue = 1;
            } else {
                $returnValue = -1;
            }
        }

        return $returnValue;
    }

    /**
     *  Vérifie que le mail entrée n'est pas déjà présent dans la base de donnée
     */

    public function checkIfMailAlreadyExist() {
        $returnValue = -2;
        if (preg_match(regex::getPrefix(), $this->prefix)) {
            $userTable = $this->prefix . 'user';
            $checkMail = $this->db->prepare('SELECT 1 FROM `' . $userTable . '` WHERE `mail` = :mail');

            $checkMail->bindValue(':mail', $this->mail, PDO::PARAM_STR);

            if ($checkMail->execute()) {
                $returnValue = $checkMail->fetch() != null;
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    /**
     *  Vérifie que le nom d'utilisateur entrée n'est pas déjà présent dans la base de donnée
     */

    public function checkIfUsernameAlreadyExist() {
        $returnValue = -2;
        if (preg_match(regex::getPrefix(), $this->prefix)) {
            $userTable = $this->prefix . 'user';
            $checkUsername = $this->db->prepare('SELECT 1 FROM `' . $userTable . '` WHERE `username` = :username');

            $checkUsername->bindValue(':username', $this->username, PDO::PARAM_STR);

            if ($checkUsername->execute()) {
                $returnValue = $checkUsername->fetch() != null;
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    /**
     * Récupére les informations de l'utilisateur via son mail
     */

    public function getUserByMail() {
        $returnValue = -2;
        if (preg_match(regex::getPrefix(), $this->prefix)) {
            $userTable = $this->prefix . 'user';
            $getUser = $this->db->prepare('SELECT `id`, `mail`, `password`, `username`, `color`  FROM `' . $userTable . '` WHERE `mail` = :mail');

            $getUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);

            if ($getUser->execute()) {
                $returnValue = $this->setUserData($getUser->fetch(PDO::FETCH_OBJ));
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    /**
     * Récupére les informations de l'utilisateur via son nom d'utilisateur
     */

    public function getUserByUsername() {
        $returnValue = -2;
        if (preg_match(regex::getPrefix(), $this->prefix)) {
            $userTable = $this->prefix . 'user';
            $getUser = $this->db->prepare('SELECT `id`, `mail`, `password`, `username`, `color`  FROM `' . $userTable . '` WHERE `username` = :username');

            $getUser->bindValue(':username', $this->username, PDO::PARAM_STR);

            if ($getUser->execute()) {
                $returnValue = $this->setUserData($getUser->fetch(PDO::FETCH_OBJ));
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    /**
     * Récupére les informations de l'utilisateur via son id
     */

    public function getUserByID() {
        $returnValue = -2;
        if (preg_match(regex::getPrefix(), $this->prefix)) {
            $userTable = $this->prefix . 'user';
            $getUser = $this->db->prepare('SELECT `id`, `mail`, `password`, `username`, `color`  FROM `' . $userTable . '` WHERE `id` = :id');

            $getUser->bindValue(':id', $this->id, PDO::PARAM_STR);

            if ($getUser->execute()) {
                $returnValue = $this->setUserData($getUser->fetch(PDO::FETCH_OBJ));
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    /**
     * Modifie les informations de l'utilisateur via son id
     */

    public function updateUserWithoutPasswordById() {
        $returnValue = -2;
        if (preg_match(regex::getPrefix(), $this->prefix)) {
            $userTable = $this->prefix . 'user';

            $updateUser = $this->db->prepare('UPDATE `' . $userTable . '` SET `mail` = LCASE(:mail), `username` = CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2)) WHERE `id` = :id');
            $updateUser->bindValue(':id', $this->id, PDO::PARAM_STR);
            $updateUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);
            $updateUser->bindValue(':username', $this->username, PDO::PARAM_STR);

            if ($updateUser->execute()) {
                $returnValue = 1;
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    /**
     * Supprime un utilisateur via son id
     */

    public function deleteUserById() {
        $returnValue = -2;
        if (preg_match(regex::$prefix, $this->prefix)) {
            $userTable = $this->prefix . 'user';
            $scoreTable = $this->prefix . 'score';

            $deleteUser = $this->db->prepare('DELETE `' . $userTable . '` FROM `' . $userTable . '` WHERE `' . $userTable . '`.`id` = :id;'
                    . 'DELETE `' . $scoreTable . '` FROM `' . $scoreTable . '` WHERE `' . $scoreTable . '`.`id` = :id;  ');
            
            $deleteUser->bindValue(':id', $this->id, PDO::PARAM_STR);

            if ($deleteUser->execute()) {
                $returnValue = 1;
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }
            
    /**
     * Stocke les données du paramétre dans les variables de l'instance de cette classe
     * @param $userData données d'un utilisateur récupéré d'une requête sql
     */

    private function setUserData($userData) {
        $returnValue = 0;
        if (is_object($userData)) {
            $this->id = $userData->id;
            $this->username = $userData->username;
            $this->mail = $userData->mail;
            $this->hashedPassword = $userData->password;
            $this->image = $userData->id . '.png';
            $this->color = $userData->color;
            $returnValue = 1;
        }
        return $returnValue;
    }

}
