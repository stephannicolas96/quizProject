<?php

include_once path::getClassesPath() . 'database.php';

class user extends database {

    public $id;
    public $email;
    public $username;
    public $password;
    public $color;
    //TODO : PUT THIS ELSEWHERE
    private $colorsForUserCreation = ['F9D400', '4ED37C', '00C7FF', 'DC00FF'];

    /**
     * Add a user to the database
     * (false = user wasn't added, true = user added)
     * @return boolean 
     */
    public function addUser() {
        $returnValue = false;
        $query = 'INSERT INTO `' . database::PREFIX . 'user` (`email`, `password`, `username`, `color`) '
                . 'VALUES ( '
                . 'LCASE(:email), '
                . ':password, '
                . 'CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2)), '
                . ':color '
                . ')';

        $addUserToDB = database::getInstance()->prepare($query);
        $addUserToDB->bindValue(':email', $this->email, PDO::PARAM_STR);
        $addUserToDB->bindValue(':password', $this->password, PDO::PARAM_STR);
        $addUserToDB->bindValue(':username', $this->username, PDO::PARAM_STR);
        $addUserToDB->bindValue(':color', $this->colorsForUserCreation[rand(0, count($this->colorsForUserCreation) - 1)], PDO::PARAM_STR);

        if ($addUserToDB->execute()) {
            $returnValue = true;
        }
        return $returnValue;
    }

    /**
     * Check if the email already exist in the database
     * (false = email doesn't exist, true = email already used)
     * @return boolean
     */
    public function checkIfEmailAlreadyExist() {
        $returnValue = false;
        $query = 'SELECT `id` '
                . 'FROM `' . database::PREFIX . 'user` '
                . 'WHERE `email` = :email';

        $checkEmail = database::getInstance()->prepare($query);
        $checkEmail->bindValue(':email', $this->email, PDO::PARAM_STR);

        if ($checkEmail->execute()) {
            $returnValue = $checkEmail->fetchColumn() != false;
        }
        return $returnValue;
    }

    /**
     *  Check if the username already exist in the database
     *  (false = username doesn't exist, true = username already used)
     * @return boolean
     */
    public function checkIfUsernameAlreadyExist() {
        $returnValue = false;
        $query = 'SELECT `username` '
                . 'FROM `' . database::PREFIX . 'user` '
                . 'WHERE `username` = :username';

        $checkUsername = database::getInstance()->prepare($query);
        $checkUsername->bindValue(':username', $this->username, PDO::PARAM_STR);

        if ($checkUsername->execute()) {
            $returnValue = $checkUsername->fetchColumn() != false;
        }
        return $returnValue;
    }

    /**
     * Get user information using EMAIL
     * (null = no user found, obj = user data)
     * @return obj
     */
    public function getUserByEmail() {
        $returnValue = null;
        $query = 'SELECT `id`, `email`, `password`, `username`, `color`, CONCAT(`id`,".png") AS `image` '
                . 'FROM `' . database::PREFIX . 'user` '
                . 'WHERE `email` = :email';

        $getUser = database::getInstance()->prepare($query);
        $getUser->bindValue(':email', $this->email, PDO::PARAM_STR);

        if ($getUser->execute()) {
            $returnValue = $getUser->fetch(PDO::FETCH_OBJ);
        }
        return $returnValue;
    }

    /**
     * Get user information using USERNAME
     * (null = no user found, obj = user data)
     * @return obj
     */
    public function getUserByUsername() {
        $returnValue = null;
        $query = 'SELECT `id`, `email`, `password`, `username`, `color`, CONCAT(`id`,".png") AS `image` '
                . 'FROM `' . database::PREFIX . 'user` '
                . 'WHERE `username` = :username';

        $getUser = database::getInstance()->prepare($query);
        $getUser->bindValue(':username', $this->username, PDO::PARAM_STR);

        if ($getUser->execute()) {
            $returnValue = $getUser->fetch(PDO::FETCH_OBJ);
        }
        return $returnValue;
    }

    /**
     * Get user information using ID
     * (null = no user found, obj = user data)
     * @return obj
     */
    public function getUserByID() {
        $returnValue = null;
        $query = 'SELECT `id`, `email`, `password`, `username`, `color`, CONCAT(`id`,".png") AS `image` '
                . 'FROM `' . database::PREFIX . 'user` '
                . 'WHERE `id` = :id';

        $getUser = database::getInstance()->prepare($query);
        $getUser->bindValue(':id', $this->id, PDO::PARAM_INT);

        if ($getUser->execute()) {
             $returnValue = $getUser->fetch(PDO::FETCH_OBJ);
        }
        return $returnValue;
    }

    /**
     * Update user informations using ID (the password isn't changed)
     *  (false = user wasn't updated, true = user updated)
     * @return boolean
     */
    public function updateUserWithoutPasswordById() {
        $returnValue = false;
        $query = 'UPDATE `' . database::PREFIX . 'user` '
                . 'SET '
                . '`email` = LCASE(:email), '
                . '`username` = CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2)) '
                . 'WHERE `id` = :id';

        $updateUser = database::getInstance()->prepare();
        $updateUser->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updateUser->bindValue(':email', $this->email, PDO::PARAM_STR);
        $updateUser->bindValue(':username', $this->username, PDO::PARAM_STR);

        if ($updateUser->execute()) {
            $returnValue = true;
        }
        return $returnValue;
    }

    /**
     * Update user informations using ID (the password isn't changed)
     *  (false = user wasn't updated, true = user updated)
     * @return boolean
     */
    public function updateUserWithPasswordById() {
        $returnValue = false;
        $query = 'UPDATE `' . database::PREFIX . 'user` '
                . 'SET '
                . ' `email` = LCASE(:email), '
                . ' `password` = :password, '
                . ' `username` = CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2)) '
                . 'WHERE `id` = :id';

        $updateUser = database::getInstance()->prepare($query);
        $updateUser->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updateUser->bindValue(':email', $this->email, PDO::PARAM_STR);
        $updateUser->bindValue(':password', $this->hashedPassword, PDO::PARAM_STR);
        $updateUser->bindValue(':username', $this->username, PDO::PARAM_STR);

        if ($updateUser->execute()) {
            $returnValue = true;
        }
        return $returnValue;
    }

    /**
     * Delete user using ID
     * (false = user wasn't deleted, true = user deleted)
     * @return boolean
     */
    public function deleteUserById() {
        $returnValue = false;
        $query = 'DELETE `user` '
                . 'FROM `' . database::PREFIX . 'user` AS `user` '
                . 'WHERE `user`.`id` = :id';

        $deleteUser = database::getInstance()->prepare();
        $deleteUser->bindValue(':id', $this->id, PDO::PARAM_INT);

        if ($deleteUser->execute()) {
            $returnValue = true;
        }
        return $returnValue;
    }
}
