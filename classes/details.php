<?php

include_once path::getClassesPath() . 'database.php';

class details extends database {

    public $id;
    public $numberOfBattle;
    public $numberOfBattleWon;
    public $numberOfBattleDraw;
    public $id_user;
    public $languageType;
    
    /**
     * 
     * @return type
     */
    public function getPlayerDetails(){
        $query = 'CALL getPlayerData(:id_user)';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
    
    /**
     * 
     * @return type
     */
    public function deleteDetailsByUserId() {
        $request = 'DELETE '
                . 'FROM `' . database::PREFIX . 'details` '
                . 'WHERE `id_user` = :id_user';

        $stmt = database::getInstance()->prepare($request);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
