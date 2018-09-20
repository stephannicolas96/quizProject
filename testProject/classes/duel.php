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
                    . 'FROM `' . $this->prefix . 'duel`'
                    . 'WHERE `startTime` < NOW() - INTERVAL 7 DAY';
            
            $deleteExpiredDuel = $this->db->prepare($request);
            
            if ($deleteExpiredDuel->execute()) {
                $returnValue = true;
            }
        }
        return $returnValue;
    }

    public function createDuel() {
        $returnValue = -2;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $currentTime = new DateTime();
            $request = 'INSERT INTO `' . $this->prefix . 'duel` (`id_' . $this->prefix . 'question`, `id_' . $this->prefix . 'user`, `id_' . $this->prefix . 'user_playerOneId`, `startTime`)'
                    . 'VALUES('
                    . ' :questionId,'
                    . ' :playerTwoId,'
                    . ' :playerOneId,'
                    . ' FROM_UNIXTIME(:startTime)'
                    . ')';

            $createDuel = $this->db->prepare($request);
            $createDuel->bindValue(':questionId', $this->mail, PDO::PARAM_INT);
            $createDuel->bindValue(':playerOneId', $this->username, PDO::PARAM_INT);
            $createDuel->bindValue(':playerTwoId', $this->hashedPassword, PDO::PARAM_INT);
            $createDuel->bindValue(':startTime', $currentTime->getTimestamp(), PDO::PARAM_STR);


            if ($createDuel->execute()) {
                $returnValue = 1;
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

}
