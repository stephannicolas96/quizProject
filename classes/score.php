<?php

include_once path::getClassesPath() . 'database.php';

class score extends database {

    public $id;
    public $points;
    public $userId;
    public $languageType;
    
    public function getLeaderboardAroundPlayer() {
        $query = 'CALL getLeaderboardAroundPlayer(:userId, :langageType);';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':userId', $this->userId, PDO::PARAM_INT);
        $stmt->bindValue(':langageType', $this->langageType, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
    
    public function getTopThree() {
        $query = 'CALL getTopThree(:langageType)';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':langageType', $this->langageType, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
    
    public function getTopTwentyOffsetThree() {
        $query = 'CALL getTopTwentyOffsetThree(:langageType)';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':langageType', $this->langageType, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }

}
