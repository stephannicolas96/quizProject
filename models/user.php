<?php

include_once path::getClassesPath() . 'database.php';

class user extends database {

    public $id;
    public $email;
    public $username;
    public $password;
    public $color;
    public $image;
    private $colorsForUserCreation = ['3F0B1B', '7A1631', 'CF423C', 'FC7D49', 'FFD462'];

    /**
     * Add a user to the database
     * @return bool
     */
    public function addUser() {
        $query = 'INSERT INTO `' . config::PREFIX . 'user` (`email`, `password`, `username`, `color`) '
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
     * @return bool
     */
    public static function checkIfEmailAlreadyExist($email) {
        $returnValue = false;
        $query = 'SELECT `id` '
                . 'FROM `' . config::PREFIX . 'user` '
                . 'WHERE `email` = :email';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetch(pdo::FETCH_COLUMN) != false;
        }
        return $returnValue;
    }

    /**
     *  Check if the username already exist in the database
     * @return bool
     */
    public static function checkIfUsernameAlreadyExist($username) {
        $returnValue = false;
        $query = 'SELECT `username` '
                . 'FROM `' . config::PREFIX . 'user` '
                . 'WHERE `username` = :username';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetch(pdo::FETCH_COLUMN) != false;
        }
        return $returnValue;
    }

    /**
     * Get user information using EMAIL
     * @return bool
     */
    public function getUserByEmail() {
        $returnValue = false;
        $query = 'SELECT `id`, `email`, `password`, `username`, `color`, CONCAT(`id`,".png") AS `image` '
                . 'FROM `' . config::PREFIX . 'user` '
                . 'WHERE `email` = :email';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            if (is_object($data)) {
                $this->id = $data->id;
                $this->email = $data->email;
                $this->password = $data->password;
                $this->username = $data->username;
                $this->color = $data->color;
                $this->image = $data->image;
                $returnValue = true;
            }
        }
        return $returnValue;
    }

    /**
     * Get user information using USERNAME
     * @return bool
     */
    public function getUserByUsername() {
        $returnValue = false;
        $query = 'SELECT `id`, `email`, `password`, `username`, `color`, CONCAT(`id`,".png") AS `image` '
                . 'FROM `' . config::PREFIX . 'user` '
                . 'WHERE `username` = :username';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            if (is_object($data)) {
                $this->id = $data->id;
                $this->email = $data->email;
                $this->password = $data->password;
                $this->username = $data->username;
                $this->color = $data->color;
                $this->image = $data->image;
                $returnValue = true;
            }
        }
        return $returnValue;
    }

    /**
     * Get user information using USERNAME
     * @return int
     */
    public function getUserIdByUsername() {
        $returnValue = -1;
        $query = 'SELECT `id` '
                . 'FROM `' . config::PREFIX . 'user` '
                . 'WHERE `username` = :username';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetch(pdo::FETCH_COLUMN);
        }
        return $returnValue;
    }

    /**
     * get 10 username where the username if like the current username
     * @return array()
     */
    public function getTenUsernameLike() {
        $returnValue = array();
        $query = 'SELECT `username`, CONCAT(`id`,".png") AS `image` '
                . 'FROM `' . config::PREFIX . 'user` '
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
     * @return bool
     */
    public function getUserByID() {
        $returnValue = false;
        $query = 'SELECT `id`, `email`, `password`, `username`, `color`, CONCAT(`id`,".png") AS `image` '
                . 'FROM `' . config::PREFIX . 'user` '
                . 'WHERE `id` = :id';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            if (is_object($data)) {
                $this->id = $data->id;
                $this->email = $data->email;
                $this->password = $data->password;
                $this->username = $data->username;
                $this->color = $data->color;
                $this->image = $data->image;
                $returnValue = true;
            }
        }
        return $returnValue;
    }

    /**
     * Update user informations using ID (the password isn't changed)
     * @return bool
     */
    public function updateUserWithoutPasswordById() {
        $query = 'UPDATE `' . config::PREFIX . 'user` '
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
     * @return bool
     */
    public function updateUserWithPasswordById() {
        $query = 'UPDATE `' . config::PREFIX . 'user` '
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
     * @return boolean
     */
    public function deleteUserById() {
        $query = 'DELETE `user` '
                . 'FROM `' . config::PREFIX . 'user` AS `user` '
                . 'WHERE `user`.`id` = :id';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * get the last user id
     * @return int
     */
    public function getLastUserId() {
        $returnValue = -1;
        $query = 'SELECT MAX(`id`) AS `id`'
                . 'FROM `' . config::PREFIX . 'user`';

        if ($result = database::getInstance()->query($query)) {
            $returnValue = $result->fetch(PDO::FETCH_COLUMN);
        }
        return $returnValue;
    }

    /**
     * get a random user id
     * @return int
     */
    public function getRandomUserId() {
        $returnValue = -1;
        $query = 'SELECT `u`.`id`' .
                'FROM `T7rDZC_user` AS `u` ' .
                'JOIN (SELECT ' .
                'ROUND(RAND() * (SELECT ' .
                'MAX(`id`) ' .
                'FROM `T7rDZC_user` ' .
                ')) AS `id` ' .
                ') AS `x`' .
                'WHERE `u`.`id` >= `x`.`id` AND `u`.`id` != :id ' .
                'LIMIT 1';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            if ($data != null) {
                $returnValue = $data->id;
            }
        }
        return $returnValue;
    }

}
