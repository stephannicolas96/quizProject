<?php

include_once path::getClassesPath() . 'database.php';

class duel extends database {

    public $id;
    public $id_question;
    public $id_playerOne;
    public $id_playerTwo;
    public $playerOneEndTime;
    public $playerTwoEndTime;
    public $startTime;

    /**
     * delete all that are older than 7 day
     * (false = duel weren't deleted, true = duel deteled)
     * @return boolean
     */
    public function deleteExpiredDuel() {
        $returnValue = false;
        $request = 'DELETE'
                . 'FROM `' . database::PREFIX . 'duel`'
                . 'WHERE `startTime` < NOW() - INTERVAL 7 DAY';

        $stmt = database::getInstance()->prepare($request);

        if ($stmt->execute()) {
            $returnValue = true;
        }
        return $returnValue;
    }

    /**
     * 
     * @return boolean
     */
    public function createDuel() {
        $returnValue = false;
        $currentTime = new DateTime();
        $this->startTime = $currentTime->getTimestamp();
        $query = 'INSERT INTO `' . database::PREFIX . 'duel` (`id_question`, `id_playerOne`, `id_playerTwo`, `playerOneEndTime`, `playerTwoEndTime`, `startTime`)'
                . 'VALUES('
                . ':id_question, '
                . ':id_playerOne, '
                . ':id_playerTwo, '
                . ':playerOneEndTime, '
                . ':playerTwoEndTime, '
                . 'FROM_UNIXTIME(:startTime)'
                . ')';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id_question', $this->id_question, PDO::PARAM_INT);
        $stmt->bindValue(':id_playerOne', $this->id_playerOne, PDO::PARAM_INT);
        $stmt->bindValue(':id_playerTwo', $this->id_playerTwo, PDO::PARAM_INT);
        $stmt->bindValue(':playerOneEndTime', $this->playerOneEndTime, PDO::PARAM_INT);
        $stmt->bindValue(':playerTwoEndTime', $this->playerTwoEndTime, PDO::PARAM_INT);
        $stmt->bindValue(':startTime', $this->startTime, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $returnValue = true;
        }
        return $returnValue;
    }

}
