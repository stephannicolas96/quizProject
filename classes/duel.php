<?php

include_once path::getClassesPath() . 'database.php';

class duel extends database {

    public $id;
    public $id_question;
    public $id_langageName;
    public $startTime;
    
    /**
     * 
     * @return boolean
     */
    public function createDuel() {
        $currentTime = new DateTime();
        $this->startTime = $currentTime->getTimestamp();
        $query = 'INSERT INTO `' . database::PREFIX . 'duel` (`id_question`, `id_langageName`, `startTime`)'
                . 'VALUES('
                . ':id_question, '
                . ':id_langageName, '
                . ':startTime '
                . ')';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id_question', $this->id_question, PDO::PARAM_INT);
        $stmt->bindValue(':id_langageName', $this->id_langageName, PDO::PARAM_INT);
        $stmt->bindValue(':startTime', $this->startTime, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    /**
     * 
     * @return type
    */
    /*
    public function deleteDuelByUserId() {
        $request = 'DELETE '
                . 'FROM `' . database::PREFIX . 'duel` '
                . 'WHERE `id_playerOne` = :id_playerOne OR `id_playerTwo` = :id_playerTwo';

        $stmt = database::getInstance()->prepare($request);
        $stmt->bindValue(':id_playerOne', $this->id_playerOne, PDO::PARAM_INT);
        $stmt->bindValue(':id_playerTwo', $this->id_playerTwo, PDO::PARAM_INT);

        return $stmt->execute();
    }
    */
}
