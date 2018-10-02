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
        $query = 'SELECT `lt`.`type`, `d`.`numberOfBattle` AS `battle`, `d`.`numberOfBattleWon` AS `won`, `d`.`numberOfBattleDraw` AS `draw`, (`d`.`numberOfBattle` - (`d`.`numberOfBattleWon` + `d`.`numberOfBattleDraw`)) AS `lost` '
                . 'FROM `' . database::PREFIX . 'details` AS `d` '
                . 'RIGHT JOIN `' . database::PREFIX . 'langageType` AS `lt` ON `lt`.`id`=`d`.`id_langageType` '
                . 'WHERE `d`.`id_user` = :user OR `d`.`id_user` IS NULL';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':user', $this->userId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }

}
