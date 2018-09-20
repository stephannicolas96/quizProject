<?php

include_once path::getClassesPath() . 'database.php';

class user extends database {

    public $id = null;
    public $email = null;
    public $username = null;
    public $password = null;
    public $color = null;
    
    //TODO : PUT THIS ELSEWHERE
    public $newPassword = null;
    public $hashedPassword = null;
    public $databaseHashedPassword = null;
    public $image = null;
    public $confirmPassword = null;
    private $colorsForUserCreation = ['F9D400', '4ED37C', '00C7FF', 'DC00FF'];

    /**
     * Add a user to the database
     * (false = user wasn't added, true = user added)
     * @return boolean 
     */
    public function addUser() {
        $returnValue = false;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {   
            $request = 'INSERT INTO `' . $this->prefix . 'user` (`email`, `password`, `username`, `color`) '
                    . 'VALUES ('
                    . 'LCASE(:email),'
                    . ':password,'
                    . 'CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2)),'
                    . ':color'
                    . ')';
            
            $addUserToDB = $this->db->prepare($request);
            $addUserToDB->bindValue(':email', $this->email, PDO::PARAM_STR);
            $addUserToDB->bindValue(':password', $this->hashedPassword, PDO::PARAM_STR);
            $addUserToDB->bindValue(':username', $this->username, PDO::PARAM_STR);
            $addUserToDB->bindValue(':color', $this->colorsForUserCreation[rand(0, count($this->colorsForUserCreation) - 1)], PDO::PARAM_STR);

            if ($addUserToDB->execute()) {
                $returnValue = true;
            }
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
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $request = 'SELECT `id`'
                    . 'FROM `' . $this->prefix . 'user`'
                    . 'WHERE `email` = :email';
            
            $checkEmail = $this->db->prepare($request);
            $checkEmail->bindValue(':email', $this->email, PDO::PARAM_STR);

            if ($checkEmail->execute()) {
                $returnValue = !is_null($checkEmail->fetchColumn());
            }
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
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $request = 'SELECT `username`'
                    . 'FROM `' . $this->prefix . 'user`'
                    . 'WHERE `username` = :username';
            
            $checkUsername = $this->db->prepare($request);
            $checkUsername->bindValue(':username', $this->username, PDO::PARAM_STR);

            if ($checkUsername->execute()) {
                $returnValue = !is_null($checkUsername->fetchColumn());
            }
        }
        return $returnValue;
    }

    /**
     * Get user information using EMAIL
     * (null = no user found, obj = user data)
     * @return obj
     */
    public function getUserByEmail() {
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $request = 'SELECT `id`, `email`, `password`, `username`, `color`'
                    . 'FROM `' . $this->prefix . 'user`'
                    . 'WHERE `email` = :email';
            
            $getUser = $this->db->prepare($request);
            $getUser->bindValue(':email', $this->email, PDO::PARAM_STR);

            if ($getUser->execute()) {
                return $getUser->fetch(PDO::FETCH_OBJ);
            }
        }
    }

    /**
     * Get user information using USERNAME
     * (null = no user found, obj = user data)
     * @return obj
     */
    public function getUserByUsername() {
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $request = 'SELECT `id`, `email`, `password`, `username`, `color`'
                    . 'FROM `' . $this->prefix . 'user`'
                    . 'WHERE `username` = :username';
            
            $getUser = $this->db->prepare($request);
            $getUser->bindValue(':username', $this->username, PDO::PARAM_STR);

            if ($getUser->execute()) {
                return $getUser->fetch(PDO::FETCH_OBJ);
            }
        }
    }

    /**
     * Get user information using ID
     * (null = no user found, obj = user data)
     * @return obj
     */
    public function getUserByID() {
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $request = 'SELECT `id`, `email`, `password`, `username`, `color`'
                    . 'FROM `' . $this->prefix . 'user`'
                    . 'WHERE `id` = :id';
            
            $getUser = $this->db->prepare($request);
            $getUser->bindValue(':id', $this->id, PDO::PARAM_INT);

            if ($getUser->execute()) {
                return $getUser->fetch(PDO::FETCH_OBJ);
            }
        }
    }

    /**
     * Update user informations using ID (the password isn't changed)
     *  (false = user wasn't updated, true = user updated)
     * @return boolean
     */
    public function updateUserWithoutPasswordById() {
        $returnValue = false;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $request = 'UPDATE `' . $this->prefix . 'user`'
                    . 'SET '
                    . ' `email` = LCASE(:email),'
                    . ' `username` = CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2))'
                    . 'WHERE `id` = :id';
            
            $updateUser = $this->db->prepare();
            $updateUser->bindValue(':id', $this->id, PDO::PARAM_INT);
            $updateUser->bindValue(':email', $this->email, PDO::PARAM_STR);
            $updateUser->bindValue(':username', $this->username, PDO::PARAM_STR);

            if ($updateUser->execute()) {
                $returnValue = true;
            }
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
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $request = 'UPDATE `' . $this->prefix . 'user` '
                    . 'SET '
                    . ' `email` = LCASE(:email),'
                    . ' `password` = :password, '
                    . ' `username` = CONCAT(UCASE(LEFT(:username, 1)), SUBSTRING(:username, 2))'
                    . 'WHERE `id` = :id';
            
            $updateUser = $this->db->prepare($request);
            $updateUser->bindValue(':id', $this->id, PDO::PARAM_INT);
            $updateUser->bindValue(':email', $this->email, PDO::PARAM_STR);
            $updateUser->bindValue(':password', $this->hashedPassword, PDO::PARAM_STR);
            $updateUser->bindValue(':username', $this->username, PDO::PARAM_STR);

            if ($updateUser->execute()) {
                $returnValue = true;
            }
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
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $request = 'DELETE `user`'
                    . 'FROM `' . $this->prefix . 'user` AS `user`'
                    . 'FULL OUTER JOIN `' . $this->prefix . 'score` AS `score` ON `user`.`id`=`score`.`id`'
                    . 'WHERE `user`.`id` = :id';
            
            $deleteUser = $this->db->prepare();
            $deleteUser->bindValue(':id', $this->id, PDO::PARAM_INT);

            if ($deleteUser->execute()) {
                $returnValue = true;
            }
        }
        return $returnValue;
    }

}
