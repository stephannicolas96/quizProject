<?php

include_once path::getClassesPath() . 'database.php';

class duel extends database {
    
    public $id;
    public $questionId;
    public $playerOneId;
    public $playerTwoId;
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
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $request = 'DELETE'
                    . 'FROM `' . database::PREFIX . 'duel`'
                    . 'WHERE `startTime` < NOW() - INTERVAL 7 DAY';
            
            $deleteExpiredDuel = database::getInstance()->prepare($request);
            
            if ($deleteExpiredDuel->execute()) {
                $returnValue = true;
            }
        }
        return $returnValue;
    }

    public function createDuel() {
        $returnValue = false;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $currentTime = new DateTime();
            $query = 'INSERT INTO `' . database::PREFIX . 'duel` (`id_' . database::PREFIX . 'question`, `id_' . database::PREFIX . 'user`, `id_' . database::PREFIX . 'user_playerOneId`, `startTime`)'
                    . 'VALUES('
                    . ' :questionId,'
                    . ' :playerTwoId,'
                    . ' :playerOneId,'
                    . ' FROM_UNIXTIME(:startTime)'
                    . ')';

            $createDuel = database::getInstance()->prepare($query);
            $createDuel->bindValue(':questionId', $this->mail, PDO::PARAM_INT);
            $createDuel->bindValue(':playerOneId', $this->username, PDO::PARAM_INT);
            $createDuel->bindValue(':playerTwoId', $this->hashedPassword, PDO::PARAM_INT);
            $createDuel->bindValue(':startTime', $currentTime->getTimestamp(), PDO::PARAM_STR);

            if ($createDuel->execute()) {
                $returnValue = true;
            }
        }
        return $returnValue;
    }

}
