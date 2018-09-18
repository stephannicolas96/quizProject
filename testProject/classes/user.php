<?php

include_once path::getClassesPath() . 'database.php';

class user extends database {

    public $id = null;
    public $username = null;
    public $email = null;
    public $password = null;
    public $confirmPassword = null;
    public $newPassword = null;
    public $hashedPassword = null;
    public $databaseHashedPassword = null;
    public $image = null;
    public $color = null;
    private $colorsForUserCreation = ['F9D400', '4ED37C', '00C7FF', 'DC00FF'];

    /**
     * Add a user to the database
     * (-2 = prefix doesn't match regex, -1 = request execution fails, 1 = success)
     * @return int 
     */
    public function addUser() {
        $returnValue = -2;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $addUserToDB = $this->db->prepare('INSERT INTO `' . $this->prefix . 'user` (`email`, `password`, `username`, `color`) ' . 'VALUES (LCASE(:email), :password, CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2)), :color)');
            $addUserToDB->bindValue(':email', $this->email, PDO::PARAM_STR);
            $addUserToDB->bindValue(':password', $this->hashedPassword, PDO::PARAM_STR);
            $addUserToDB->bindValue(':username', $this->username, PDO::PARAM_STR_NATL);
            $addUserToDB->bindValue(':color', $this->colorsForUserCreation[rand(0, count($this->colorsForUserCreation) - 1)], PDO::PARAM_STR);

            if ($addUserToDB->execute()) {
                $returnValue = 1;
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    /**
     * Check if the email already exist in the database
     * (-2 = prefix doesn't match regex, -1 = request execution fails, 0 = email doesn't exist, 1 = email already exist)
     * @return int
     */
    public function checkIfEmailAlreadyExist() {
        $returnValue = -2;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $checkEmail = $this->db->prepare('SELECT COUNT(`email`) FROM `' . $this->prefix . 'user` WHERE `email` = :email');
            $checkEmail->bindValue(':email', $this->email, PDO::PARAM_STR);

            if ($checkEmail->execute()) {
                $returnValue = $checkEmail->fetchColumn();
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    /**
     *  Check if the username already exist in the database
     *  (-2 = prefix doesn't match regex, -1 = request execution fails, 0 = username doesn't exist, 1 = username already exist)
     * @return int
     */
    public function checkIfUsernameAlreadyExist() {
        $returnValue = -2;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $checkUsername = $this->db->prepare('SELECT COUNT(`username`) FROM `' . $this->prefix . 'user` WHERE `username` = :username');
            $checkUsername->bindValue(':username', $this->username, PDO::PARAM_STR_NATL);

            if ($checkUsername->execute()) {
                $returnValue = $checkUsername->fetchColumn();
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    /**
     * Get user information using EMAIL
     * (-2 = prefix doesn't match regex, -1 = request execution fails, 0 = user data not found, 1 = success)
     * @return int
     */
    public function getUserByEmail() {
        $returnValue = -2;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $getUser = $this->db->prepare('SELECT `id`, `email`, `password`, `username`, `color`  FROM `' . $this->prefix . 'user` WHERE `email` = :email');
            $getUser->bindValue(':email', $this->email, PDO::PARAM_STR);

            if ($getUser->execute()) {
                $returnValue = $this->setUserData($getUser->fetch(PDO::FETCH_OBJ));
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    /**
     * Get user information using USERNAME
     * (-2 = prefix doesn't match regex, -1 = request execution fails, 0 = user data not found, 1 = success)
     * @return int
     */
    public function getUserByUsername() {
        $returnValue = -2;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $getUser = $this->db->prepare('SELECT `id`, `email`, `password`, `username`, `color`  FROM `' . $this->prefix . 'user` WHERE `username` = :username');
            $getUser->bindValue(':username', $this->username, PDO::PARAM_STR_NATL);

            if ($getUser->execute()) {
                $returnValue = $this->setUserData($getUser->fetch(PDO::FETCH_OBJ));
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    /**
     * Get user information using ID
     * (-2 = prefix doesn't match regex, -1 = request execution fails, 0 = user data not found, 1 = success)
     * @return int
     */
    public function getUserByID() {
        $returnValue = -2;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $getUser = $this->db->prepare('SELECT `id`, `email`, `password`, `username`, `color`  FROM `' . $this->prefix . 'user` WHERE `id` = :id');
            $getUser->bindValue(':id', $this->id, PDO::PARAM_INT);

            if ($getUser->execute()) {
                $returnValue = $this->setUserData($getUser->fetch(PDO::FETCH_OBJ));
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    /**
     * Stocke les données du paramétre dans les variables de l'instance de cette classe
     * (0 = userData wasn't an object, 1 = success);
     * @param $userData données d'un utilisateur récupéré d'une requête sql
     * @return int
     */
    private function setUserData($userData) {
        $returnValue = 0;
        if (is_object($userData)) {
            $this->id = $userData->id;
            $this->username = $userData->username;
            $this->email = $userData->email;
            $this->databaseHashedPassword = $userData->password;
            $this->image = $userData->id . '.png';
            $this->color = $userData->color;
            $returnValue = 1;
        }
        return $returnValue;
    }

    /**
     * Update user informations using ID (the password isn't changed)
     *  (-2 = prefix doesn't match regex, -1 = request execution fails, 1 = sucess)
     * @return int
     */
    public function updateUserWithoutPasswordById() {
        $returnValue = -2;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $updateUser = $this->db->prepare('UPDATE `' . $this->prefix . 'user` SET `email` = LCASE(:email), `username` = CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2)) WHERE `id` = :id');
            $updateUser->bindValue(':id', $this->id, PDO::PARAM_INT);
            $updateUser->bindValue(':email', $this->email, PDO::PARAM_STR);
            $updateUser->bindValue(':username', $this->username, PDO::PARAM_STR_NATL);

            if ($updateUser->execute()) {
                $returnValue = 1;
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    /**
     * Update user informations using ID (the password isn't changed)
     *  (-2 = prefix doesn't match regex, -1 = request execution fails, 1 = sucess)
     * @return int
     */
    public function updateUserWithPasswordById() {
        $returnValue = -2;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $updateUser = $this->db->prepare('UPDATE `' . $this->prefix . 'user` SET `email` = LCASE(:email),`password` = :password, `username` = CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2)) WHERE `id` = :id');
            $updateUser->bindValue(':id', $this->id, PDO::PARAM_INT);
            $updateUser->bindValue(':email', $this->email, PDO::PARAM_STR);
            $updateUser->bindValue(':password', $this->hashedPassword, PDO::PARAM_STR);
            $updateUser->bindValue(':username', $this->username, PDO::PARAM_STR_NATL);

            if ($updateUser->execute()) {
                $returnValue = 1;
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    /**
     * Delete user using ID
     * (-2 = prefix doesn't match regex, -1 = request execution fails, 1 = sucess)
     * @return int
     */
    public function deleteUserById() {
        $returnValue = -2;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $deleteUser = $this->db->prepare('DELETE `' . $this->prefix . 'user` FROM `' . $this->prefix . '` WHERE `' . $this->prefix . 'user`.`id` = :id;' . 'DELETE `' . $this->prefix . 'score` FROM `' . $this->prefix . 'score` WHERE `' . $this->prefix . 'score`.`id` = :id;  ');
            $deleteUser->bindValue(':id', $this->id, PDO::PARAM_INT);

            if ($deleteUser->execute()) {
                $returnValue = 1;
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

}