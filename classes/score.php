<?php

include_once path::getClassesPath() . 'database.php';

class score extends database {

    public $id;
    public $points;
    public $userId;
    public $languageType;
    
    public function getScoresAroundUserByLanguageTypeOrdered() {
        $query = 'CALL getPlayerRowInRank(:userId, :langageType);';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':userId', $this->userId, PDO::PARAM_INT);
        $stmt->bindValue(':langageType', $this->langageType, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
    
    public function getTopThreeByLanguageTypeOrdered() {
        $query = 'SELECT `score`.`points`, `user`.`id`, `user`.`username`, `user`.`color`, CONCAT(`user`.`id`, ".png") AS `image` '
                . 'FROM `' . database::PREFIX . 'score` AS `score` '
                . 'INNER JOIN `' . database::PREFIX . 'user` AS `user` ON `user`.`id`=`score`.`id_user` '
                . 'WHERE `id_langageType` = :langageType '
                . 'ORDER BY `points` DESC '
                . 'LIMIT 3';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':langageType', $this->langageType, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }

}
