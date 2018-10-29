<?php

include_once path::getClassesPath() . 'database.php';

class userDuel extends database {

    public $id;
    public $endTime;
    public $id_duel;
    public $id_duelState;
    public $id_user;
    
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

}
