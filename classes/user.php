<?php

include_once path::getClassesPath() . 'database.php';

class user extends database {

    public $id;
    public $email;
    public $username;
    public $password;
    public $color;
    private $colorsForUserCreation = ['3F0B1B', '7A1631', 'CF423C', 'FC7D49', 'FFD462'];
    
    /**
     * Add a user to the database
     * (false = user wasn't added, true = user added)
     * @return boolean 
     */
    public function addUser() {
        $query = 'INSERT INTO `' . database::PREFIX . 'user` (`email`, `password`, `username`, `color`) '
                . 'VALUES ( '
                . 'LCASE(:email), '
                . ':password, '
                . 'CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2)), '
                . ':color '
                . ')';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':color', $this->colorsForUserCreation[rand(0, count($this->colorsForUserCreation) - 1)], PDO::PARAM_STR);

        return $stmt->execute();
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

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetchColumn() != false;
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

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetchColumn() != false;
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

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetch(PDO::FETCH_OBJ);
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

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetch(PDO::FETCH_OBJ);
        }
        return $returnValue;
    }
    
    /**
     * 
     * @return type
     */
     public function getTenUsernameLike() {
        $returnValue = array();
        $query = 'SELECT `username`, CONCAT(`id`,".png") AS `image` '
                . 'FROM `' . database::PREFIX . 'user` '
                . 'WHERE `username` LIKE :username AND `id` != :id '
                . 'ORDER BY `username` ASC '
                . 'LIMIT 10';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':username', '%' . $this->username . '%', PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetchAll(PDO::FETCH_OBJ);
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

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
             $returnValue = $stmt->fetch(PDO::FETCH_OBJ);
        }
        return $returnValue;
    }

    /**
     * Update user informations using ID (the password isn't changed)
     *  (false = user wasn't updated, true = user updated)
     * @return boolean
     */
    public function updateUserWithoutPasswordById() {
        $query = 'UPDATE `' . database::PREFIX . 'user` '
                . 'SET '
                . '`email` = LCASE(:email), '
                . '`username` = CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2)) '
                . 'WHERE `id` = :id';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * Update user informations using ID (the password isn't changed)
     *  (false = user wasn't updated, true = user updated)
     * @return boolean
     */
    public function updateUserWithPasswordById() {
        $query = 'UPDATE `' . database::PREFIX . 'user` '
                . 'SET '
                . ' `email` = LCASE(:email), '
                . ' `password` = :password, '
                . ' `username` = CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2)) '
                . 'WHERE `id` = :id';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * Delete user using ID
     * (false = user wasn't deleted, true = user deleted)
     * @return boolean
     */
    public function deleteUserById() {
        $query = 'DELETE `user` '
                . 'FROM `' . database::PREFIX . 'user` AS `user` '
                . 'WHERE `user`.`id` = :id';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getLastUserId() {
        $returnValue = null;
        $query = 'SELECT MAX(`id`) AS `id`'
                . 'FROM `' . database::PREFIX . 'user`';

        if ($result = database::getInstance()->query($query)) {
            $returnValue = $result->fetch(PDO::FETCH_OBJ);
        }
        return $returnValue;
    }
}
