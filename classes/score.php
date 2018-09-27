<?php

include_once path::getClassesPath() . 'database.php';

class score extends database {

    public $id;
    public $points;
    public $userId;
    public $languageType;

    public function getUserScoresByLanguageTypeOrdered() {
        $query = 'SELECT `score`.`points`, `user`.`id`, `user`.`username`, `user`.`color` '
                . 'FROM `' . database::PREFIX . 'score` AS `score` '
                . 'INNER JOIN `' . database::PREFIX . 'user` AS `user` ON `user`.`id`=`score`.`id_' . database::PREFIX . 'user` '
                . 'WHERE `id_' . database::PREFIX . 'languageType` = :languageType '
                . 'ORDER BY `points` DESC';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':languageType', $this->languageType, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
    
    public function getTopThreeByLanguageTypeOrdered() {
        $query = 'SELECT `score`.`points`, `user`.`id`, `user`.`username`, `user`.`color` '
                . 'FROM `' . database::PREFIX . 'score` AS `score` '
                . 'INNER JOIN `' . database::PREFIX . 'user` AS `user` ON `user`.`id`=`score`.`id_' . database::PREFIX . 'user` '
                . 'WHERE `id_' . database::PREFIX . 'languageType` = :languageType '
                . 'ORDER BY `points` DESC '
                . 'LIMIT 3';

        $stmt = database::getInstance()->prepare($query);
        
        $stmt->bindValue(':languageType', $this->languageType, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }

}
