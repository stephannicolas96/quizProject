<?php

include_once path::$database;

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

    /*
     * Ajoute un utilisateur à la base de donnée
     */

    public function addUser() {
        if (preg_match(regex::$prefix, $this->prefix)) {
            $userTable = $this->prefix . 'user';
            $addUserToDB = $this->db->prepare('INSERT INTO `' . $userTable . '` (`mail`, `password`, `username`, `color`) '
                    . 'VALUES (LCASE(:mail), :password, CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2)), :color)');

            $addUserToDB->bindValue(':mail', $this->mail, PDO::PARAM_STR);
            $addUserToDB->bindValue(':password', $this->hashedPassword, PDO::PARAM_STR);
            $addUserToDB->bindValue(':username', $this->username, PDO::PARAM_STR);
            $addUserToDB->bindValue(':color', $this->colors[rand(0, count($this->colors) - 1)], PDO::PARAM_STR);

            if ($addUserToDB->execute()) {
                return 1;
            } else {
                return -1;
            }
        }

        return -2;
    }

    /*
     *  Vérifie que le mail entrée n'est pas déjà présent dans la base de donnée
     */

    public function checkIfMailAlreadyExist() {
        if (preg_match(regex::$prefix, $this->prefix)) {
            $userTable = $this->prefix . 'user';
            $checkMail = $this->db->prepare('SELECT 1 FROM `' . $userTable . '` WHERE `mail` = :mail');

            $checkMail->bindValue(':mail', $this->mail, PDO::PARAM_STR);

            if ($checkMail->execute()) {
                return $checkMail->fetch() != null;
            } else {
                return -1;
            }
        }
        return -2;
    }

    /*
     *  Vérifie que le nom d'utilisateur entrée n'est pas déjà présent dans la base de donnée
     */

    public function checkIfUsernameAlreadyExist() {
        if (preg_match(regex::$prefix, $this->prefix)) {
            $userTable = $this->prefix . 'user';
            $checkUsername = $this->db->prepare('SELECT 1 FROM `' . $userTable . '` WHERE `username` = :username');

            $checkUsername->bindValue(':username', $this->username, PDO::PARAM_STR);

            if ($checkUsername->execute()) {
                return $checkUsername->fetch() != null;
            } else {
                return -1;
            }
        }
        return -2;
    }

    /*
     * 
     */

    public function getUserByMail() {
        if (preg_match(regex::$prefix, $this->prefix)) {
            $userTable = $this->prefix . 'user';
            $getUser = $this->db->prepare('SELECT `id`, `mail`, `password`, `username`, `color`  FROM `' . $userTable . '` WHERE `mail` = :mail');

            $getUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);

            if ($getUser->execute()) {
                return $this->setUserData($getUser->fetch(PDO::FETCH_OBJ));
            } else {
                return -1;
            }
        }
        return -2;
    }

    /*
     * 
     */

    public function getUserByUsername() {
        if (preg_match(regex::$prefix, $this->prefix)) {
            $userTable = $this->prefix . 'user';
            $getUser = $this->db->prepare('SELECT `id`, `mail`, `password`, `username`, `color`  FROM `' . $userTable . '` WHERE `username` = :username');

            $getUser->bindValue(':username', $this->username, PDO::PARAM_STR);

            if ($getUser->execute()) {
                return $this->setUserData($getUser->fetch(PDO::FETCH_OBJ));
            } else {
                return -1;
            }
        }
        return -2;
    }

    /*
     * 
     */

    public function getUserByID() {
        if (preg_match(regex::$prefix, $this->prefix)) {
            $userTable = $this->prefix . 'user';
            $getUser = $this->db->prepare('SELECT `id`, `mail`, `password`, `username`, `color`  FROM `' . $userTable . '` WHERE `id` = :id');

            $getUser->bindValue(':id', $this->id, PDO::PARAM_STR);

            if ($getUser->execute()) {
                return $this->setUserData($getUser->fetch(PDO::FETCH_OBJ));
            } else {
                return -1;
            }
        }
        return -2;
    }

    /*
     * 
     */

    public function updateUserById() {
        if (preg_match(regex::$prefix, $this->prefix)) {
            $userTable = $this->prefix . 'user';

            $updateUser = $this->db->prepare('UPDATE `' . $userTable . '` SET `mail` = LCASE(:mail), `password` = :password, `username` = CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2)) WHERE `id` = :id');
            $updateUser->bindValue(':id', $this->id, PDO::PARAM_STR);
            $updateUser->bindValue(':mail', $this->id, PDO::PARAM_STR);
            $updateUser->bindValue(':password', $this->id, PDO::PARAM_STR);
            $updateUser->bindValue(':username', $this->id, PDO::PARAM_STR);

            if ($getUser->execute()) {
                return $this->setUserData($getUser->fetch(PDO::FETCH_OBJ));
            } else {
                return -1;
            }
        }
        return -2;
    }

    /*
     * 
     */

    public function deleteUserById() {
        if (preg_match(regex::$prefix, $this->prefix)) {
            $userTable = $this->prefix . 'user';

            $deleteUser = $this->db->prepare('DELETE FROM `' . $userTable . '` WHERE `id` = :id');
            $deleteUser->bindValue(':id', $this->id, PDO::PARAM_STR);

            if ($deleteUser->execute()) {
                return 1;
            } else {
                return -1;
            }
        }
        return -2;
    }

    /*
     *  
     */

    private function setUserData($userData) {
        if (is_object($userData)) {
            $this->id = $userData->id;
            $this->username = $userData->username;
            $this->mail = $userData->mail;
            $this->hashedPassword = $userData->password;
            $this->image = $userData->id . '.png';
            $this->color = $userData->color;
            return 1;
        } else {
            return 0;
        }
    }

}
