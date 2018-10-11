<?php

include_once path::getClassesPath() . 'database.php';

class score extends database {

    public $id;
    public $points;
    public $id_user;
    public $id_langageName;
    
    /**
     * 
     * @return type
     */
    public function getLeaderboardAroundPlayer() {
        $query = 'CALL getLeaderboardAroundPlayer(:id_user, :id_langageName);';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        $stmt->bindValue(':id_langageName', $this->id_langageName, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
    
    /**
     * 
     * @return type
     */
    public function getTopThree() {
        $query = 'CALL getTopThree(:id_langageName)';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':id_langageName', $this->id_langageName, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
    
    /**
     * 
     * @return type
     */
    public function getTopTwentyOffsetThree() {
        $query = 'CALL getTopTwentyOffsetThree(:id_langageName)';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':id_langageName', $this->id_langageName, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
    
    /**
     * 
     * @return type
     */
    public function deleteScoreByUserId() {
        $request = 'DELETE '
                . 'FROM `' . database::PREFIX . 'score` '
                . 'WHERE `id_user` = :id_user';

        $stmt = database::getInstance()->prepare($request);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
    /**
     * 
     * @return type
     */
    public function addBaseScoreByUserId(){
        $query = 'INSERT INTO `' . database::PREFIX . 'score` (`points`, `id_user`, `id_langageName`) VALUES '
                . '(0, :id_user, 0),'
                . '(0, :id_user, 1),'
                . '(0, :id_user, 2),'
                . '(0, :id_user, 3)';

        $stmt = database::getInstance()->prepare($request);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}
