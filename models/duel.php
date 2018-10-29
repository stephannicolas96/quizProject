<?php

include_once path::getClassesPath() . 'database.php';

class duel extends database {

    public $id;
    public $id_question;
    public $id_langageName;
    public $startTime;

    /**
     * create a duel with the current time as starting time
     * @return boolean
     */
    public function createDuel() {
        $currentTime = new DateTime();
        $query = 'INSERT INTO `' . config::PREFIX . 'duel` (`id_question`, `id_langageName`, `startTime`)'
                . 'VALUES('
                . ':id_question, '
                . ':id_langageName, '
                . ':startTime '
                . ')';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id_question', $this->id_question, PDO::PARAM_INT);
        $stmt->bindValue(':id_langageName', $this->id_langageName, PDO::PARAM_INT);
        $stmt->bindValue(':startTime', $currentTime->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    /**
     * check if the current logged user is participating in the duel
     * @param type $userId
     * @return type
     */
    public function checkIfUserParticipateInTheDuel($userId) {
        $returnValue = false;
        $query = 'SELECT `d`.`id` '
                . 'FROM `' . config::PREFIX . 'duel` AS `d` '
                . 'INNER JOIN `' . config::PREFIX . 'userDuel` AS `ud` ON `ud`.`id_user`'
                . 'WHERE `d`.`id` = :id AND `ud`.`id_user` = :userId';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $returnValue = $stmt->fetch(PDO::FETCH_COLUMN) != false;
        }
        return $returnValue;
    }
    
    /**
     * get the duel langageName and question Id
     * @return boolean
     */
    public function getDuelData() {
        $returnValue = false;
        $query = 'SELECT `id_langageName`, `id_question`'
                . 'FROM `' . config::PREFIX . 'duel`'
                . 'WHERE `id` = :id ';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            if(is_object($data)){
                $this->id_langageName = $data->id_langageName;
                $this->id_question = $data->id_question;
                $returnValue = true;
            }
        }
        return $returnValue;
    }

}
