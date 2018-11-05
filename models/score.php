<?php

include_once path::getClassesPath() . 'database.php';

class score extends database {

    public $id = 0;
    public $points = 0;
    public $id_user = 0;
    public $id_langageName = 0;
    
    /**
     * get leaderboard made from 10 players before and after the targeted player
     * @return array()
     */
    public function getLeaderboardAroundPlayer() {
        $returnValue = array();
        $query = 'CALL getLeaderboardAroundPlayer(:id_user, :id_langageName);';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        $stmt->bindValue(':id_langageName', $this->id_langageName, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
        return $returnValue;
    }
    
    /**
     * get the top 3
     * @return array()
     */
    public function getTopThree() {
        $returnValue = array();
        $query = 'CALL getTopThree(:id_langageName)';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':id_langageName', $this->id_langageName, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
        return $returnValue;
    }
    
    /**
     * get the top 3 to 23
     * @return array()
     */
    public function getTopTwentyOffsetThree() {
        $returnValue = array();
        $query = 'CALL getTopTwentyOffsetThree(:id_langageName)';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':id_langageName', $this->id_langageName, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
        return $returnValue;
    }
    
    /**
     * delete the score of a user by id
     * @return bool
     */
    public function deleteScoreByUserId() {
        $request = 'DELETE '
                . 'FROM `' . config::PREFIX . 'score` '
                . 'WHERE `id_user` = :id_user';

        $stmt = database::getInstance()->prepare($request);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
    /**
     * add base score to all users without score
     * @return bool
     */
    public function addBaseScoreToLastUser(){
        $query = 'CALL addBaseScoreToLastUser()';
        
        return database::getInstance()->query($query);
    }
}
