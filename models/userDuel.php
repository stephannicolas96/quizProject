<?php

include_once path::getClassesPath() . 'database.php';

class userDuel extends database {

    public $id = 0;
    public $startTime;
    public $endTime;
    public $executionTime = 0;
    public $id_duel = 0;
    public $id_duelState = 0;
    public $id_user = 0;

    /**
     * create a user duel
     * @return bool
     */
    public function createUserDuel() {
        $query = 'INSERT INTO `' . config::PREFIX . 'userDuel` (`id_duel`, `id_duelState`, `id_user`)'
                . 'VALUES('
                . ':id_duel, '
                . ':id_duelState, '
                . ':id_user '
                . ')';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id_duel', $this->id_duel, PDO::PARAM_INT);
        $stmt->bindValue(':id_duelState', $this->id_duelState, PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * get the current user id data such as the number of duel won or lost in each langage
     * @return array()
     */
    public function getPlayerData() {
        $returnValue = array();
        $query = 'CALL getPlayerData(:id_user)';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        return $returnValue;
    }

    /**
     * get 20 duel from the current user id
     * @return array()
     */
    public function getTwentyDuelByUserId() {
        $returnValue = array();
        $query = 'CALL getTwentyDuelByUserId(:id_user)';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        return $returnValue;
    }

    /**
     * update the user duel using the duel id and the user id
     * @return array()
     */
    public function updateUserDuelByDuelIdAndUserId($duelState) {
        $query = 'UPDATE `' . config::PREFIX . 'userDuel`'
                . ' SET '
                . ' `id_duelState` = (SELECT `id` FROM `' . config::PREFIX . 'duelState` WHERE `name` = :duelState), '
                . ' `endTime` = :endTime, '
                . ' `executionTime` = :executionTime '
                . ' WHERE `id_duel` = :id_duel AND `id_user` = :id_user';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':duelState', $duelState, PDO::PARAM_STR);
        $stmt->bindValue(':id_duel', $this->id_duel, PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        $stmt->bindValue(':endTime', $this->endTime, PDO::PARAM_STR);
        $stmt->bindValue(':executionTime', $this->executionTime, PDO::PARAM_INT);

        return $stmt->execute();
    }
    
     /**
     * update the user duel startTime using the duel id and the user id
     * @return array()
     */
    public function updateStartTimeByDuelIdAnsUserId() {
        $query = 'UPDATE `' . config::PREFIX . 'userDuel`'
                . ' SET `startTime` = :startTime'
                . ' WHERE `id_duel` = :id_duel AND `id_user` = :id_user';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':startTime', $this->startTime, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * check if the duel is over and data can be computed
     * @return boolean
     */
    public function isDuelOver() {
        $returnValue = false;
        $query = 'SELECT `executionTime` '
                . 'FROM `' . config::PREFIX . 'userDuel` '
                . 'WHERE `id_duel` = :id_duel';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id_duel', $this->id_duel, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            if (is_array($result)) {
                $returnValue = true;
                foreach ($result as $line) {
                    if (is_null($line->executionTime)) {
                        $returnValue = false;
                        break;
                    }
                }
            }
        }

        return $returnValue;
    }

    /**
     * compute duel data, to get the winner and change their score
     * @return boolean
     */
    public function endDuel($id_user1, $id_user2) {
        $query = 'CALL endDuel(:id_duel, :id_user1, :id_user2)';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id_duel', $this->id_duel, PDO::PARAM_INT);
        $stmt->bindValue(':id_user1', $id_user1, PDO::PARAM_INT);
        $stmt->bindValue(':id_user2', $id_user2, PDO::PARAM_INT);

        return $stmt->execute();
    }
    
    /**
     * get the id of the two user from a duel
     * @return array()
     */
    public function getUsersId() {
        $returnValue = array();
        $query = 'SELECT `id_user` FROM `' . config::PREFIX . 'userDuel` WHERE `id_duel` = :id_duel';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id_duel', $this->id_duel, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
        return $returnValue;
    }
    
     /**
     * get the startTime of the current user
     * @return array()
     */
    public function getUserStartTime() {
        $returnValue = array();
        $query = 'SELECT `startTime` FROM `' . config::PREFIX . 'userDuel` WHERE `id_duel` = :id_duel AND `id_user` = :id_user';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id_duel', $this->id_duel, PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetch(PDO::FETCH_COLUMN);
        }
        
        return $returnValue;
    }
    
    /**
     * update the id_user of the current user to id 1 so we can keep the duel for the second user and still delete the current user
     * the user with the id 1 must be a GameMaster
     * @return array()
     */
    public function replaceAllUserDuelUserIdWithTheFirstUserId() {
        $query = 'UPDATE `' . config::PREFIX . 'userDuel`'
                . ' SET `id_user` = 1'
                . ' WHERE `id_user` = :id_user';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);

        return $stmt->execute();
    }
    
    /**
     * check if the duel is over and data can be computed
     * @return boolean
     */
    public function isDuelStarted() {
        $returnValue = false;
        $query = 'SELECT `startTime` '
                . 'FROM `' . config::PREFIX . 'userDuel` '
                . 'WHERE `id_duel` = :id_duel AND `id_user` = :id_user';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id_duel', $this->id_duel, PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_COLUMN);
            if (!is_null($result)) {
                $returnValue = true;
            }
        }

        return $returnValue;
    }

}
