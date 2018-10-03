<?php

include_once path::getClassesPath() . 'database.php';

class details extends database {

    public $id;
    public $numberOfBattle;
    public $numberOfBattleWon;
    public $numberOfBattleDraw;
    public $userId;
    public $languageType;
    
    public function getPlayerDetails(){
        $query = 'CALL getPlayerData(:user)';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':user', $this->userId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }

}
